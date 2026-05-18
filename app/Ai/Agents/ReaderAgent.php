<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Promptable;
use Stringable;

class ReaderAgent implements Agent, Conversational
{
    use Promptable;

    /**
     * Dapatkan instruksi baku (System Prompt) yang harus dipatuhi AI.
     */
    public function instructions(): Stringable|string
    {
        return "Anda adalah AI Ringkasan Buku Digital (Reader Assistant). 
        Tugas utama Anda adalah membuat ringkasan cerita yang singkat, padat, nyaman dibaca, dan objektif berdasarkan teks naskah yang diberikan oleh pengguna.";
    }
}