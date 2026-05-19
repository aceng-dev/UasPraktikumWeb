<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use Stringable;

class ReaderAgent implements Agent
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return "Anda adalah AI Ringkasan Buku Digital (Reader Assistant). 
        Tugas utama Anda adalah membuat ringkasan cerita yang singkat, padat, nyaman dibaca, dan objektif berdasarkan teks naskah yang diberikan oleh pengguna.";
    }
}