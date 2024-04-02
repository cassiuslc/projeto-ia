<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GPT4AllService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class ChatbotController extends Controller
{
    protected $gpt4AllService;

    public function __construct(GPT4AllService $gpt4AllService)
    {
        $this->gpt4AllService = $gpt4AllService;
    }

    public function index()
    {
        return view("chatbot");
    }

    public function completeChat(Request $request)
    {
        $messages = $request->input('messages');
        $response = $this->gpt4AllService->completeChat($messages);

        return response()->json($response);
    }

    public function check()
    {
        $response = $this->gpt4AllService->healthCheck();
        return response()->json($response);
    }

    public function exibirHistorico()
    {
        // Obter o histórico do Redis
        $historico = Redis::get('historico');

        if (!$historico) {
            $historico = [];
        } else {
            $historico = json_decode($historico);
        }

        return response()->json($historico);
    }

    public function inserirMensagem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mensagem' => 'required|string',
            'ator' => 'required|in:user,assistant',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $mensagem = $request->input('mensagem');
        $ator = $request->input('ator');

        // Obter o histórico atual do Redis
        $historico = Redis::get('historico');

        if (!$historico) {
            $historico = [];
        } else {
            $historico = json_decode($historico);
        }

        // Verificar a ordem de fala
        $count = count($historico);
        if ($count === 0 && $ator !== 'user') {
            return response()->json(['error' => 'A primeira interação deve ser do usuário.'], 400);
        }

        if ($count > 0 && $historico[$count - 1]->ator === $ator) {
            return response()->json(['error' => 'A ordem de fala deve ser: user -> assistant -> user'], 400);
        }

        // Adicionar nova mensagem ao histórico
        $novaMensagem = [
            'ator' => $ator,
            'mensagem' => $mensagem,
            'timestamp' => now()->timestamp,
        ];

        $historico[] = $novaMensagem;

        // Armazenar o novo histórico no Redis
        Redis::set('historico', json_encode($historico));

        $this->interacaoLLM();

        return response()->json(['message' => 'Mensagem adicionada ao histórico com sucesso!']);
    }

    public function resetarHistorico()
    {
        // Apagar o histórico do Redis
        Redis::del('historico');

        return response()->json(['message' => 'Histórico resetado com sucesso!']);
    }

    public function interacaoLLM()
    {
        // Obter as mensagens atuais do histórico
        $historico = Redis::get('historico');

        if (!$historico) {
            $historico = [];
        } else {
            $historico = json_decode($historico, true);
        }

        $data = [
            'model' => "Nous-Hermes-2-Mistral-7B-DPO.Q4_0",
            'messages' => $this->createMsgByContext(), // Adicionar mensagens existentes ao contexto
            'temperature' => 0.18,
        ];

        $resposta = $this->gpt4AllService->completeChat($data);

        // Verificar se a resposta foi bem-sucedida e se há uma mensagem do assistente
        if (isset($resposta['choices'][0]['message']) && $resposta['choices'][0]['message']['role'] === 'assistant') {
            $novaMensagem = [
                'ator' => 'assistant',
                'mensagem' => $resposta['choices'][0]['message']['content'],
                'timestamp' => time(),
            ];

            // Adicionar a nova mensagem ao histórico
            $historico[] = $novaMensagem;

            // Armazenar o novo histórico no Redis
            Redis::set('historico', json_encode($historico));
        }
    }

    public function createMsgByContext()
    {
        // Obter o histórico do Redis
        $historico = Redis::get('historico');

        if (!$historico) {
            $historico = [];
        } else {
            $historico = json_decode($historico, true);
        }

        // Array para armazenar as mensagens formatadas
        $mensagensFormatadas = [];

        // Adicionar mensagem do sistema
        $mensagemSistema = [
            "role" => "system",
            "content" => "Você é um assistente útil em assuntos jurídicos relacionados à defesa do consumidor."
        ];

        $mensagensFormatadas[] = $mensagemSistema;

        foreach ($historico as $msg) {
            $role = $msg['ator'] === 'user' ? 'user' : 'assistant';

            $mensagemFormatada = [
                "role" => $role,
                "content" => $msg['mensagem'],
            ];

            $mensagensFormatadas[] = $mensagemFormatada;
        }

        return $mensagensFormatadas;
    }



    
}
