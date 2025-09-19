<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storageLocalCreate()
    {
        // Storage::put('file2.txt', 'Conteudo do ficheiro 2'); esse é o codigo que nao deu certo, não roda
        // Storage::disk('local')->put('file2.txt', 'Conteudo do ficheiro 2'); outro que não deu certo, apenas os de baixo que dão certo

        Storage::disk('public')->put('file1.txt', 'Conteudo do ficheiro 1'); // com o public ele fica disponivel ao public (sem esse disk, porem nesse codigo atual meu n estava dando certo)
        Storage::disk('public')->put('file2.txt', 'Conteudo do ficheiro 2');

        echo "Fim!";
    }

    public function storegeLocalAppend()
    {
        Storage::append('file3.txt', Str::random(100));
    }
}
