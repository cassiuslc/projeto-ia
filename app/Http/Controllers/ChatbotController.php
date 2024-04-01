<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GPT4AllService;

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

    
}
