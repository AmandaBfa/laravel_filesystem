<x-main-layout>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <p class="text-center display-3">Laboratorio de FileSystem</p>
                <hr>

                <div class="d-flex gap-5">

                    <a href="{{ route('storage.local.create') }}" class="btn btn-primary">Criar Arquivo no Storage
                        Local</a>
                    <a href="{{ route('storage.local.append') }}" class="btn btn-primary">Acrescentar Conteúdo no Storage
                        Local</a>
                    <a href="{{ route('storage.local.read') }}" class="btn btn-primary">Ler Conteúdo do Storage Local</a>
                    <a href="{{ route('storage.local.read.multi') }}" class="btn btn-primary">Ler Arquivo com
                        Múltiplas Linhas</a>

                </div>

                <div class="d-flex gap-5 mt-5">

                    <a href="{{ route('storage.local.check.file') }}" class="btn btn-primary">Verificar a existência do
                        Arquivo</a>
                    <a href="{{ route('storage.local.store.json') }}" class="btn btn-primary">Guardar JSON</a>
                    <a href="{{ route('storage.local.read.json') }}" class="btn btn-primary">Ler JSON</a>
                    <a href="{{ route('storage.local.list') }}" class="btn btn-primary">Listar arquivos</a>
                    <a href="{{ route('storage.local.delete') }}" class="btn btn-primary">Eliminar arquivo</a>

                </div>

                <div class="d-flex gap-5 mt-5">

                    <a href="{{ route('storage.local.create.folder') }}" class="btn btn-primary">Criar Pasta</a>
                    <a href="{{ route('storage.local.delete.folder') }}" class="btn btn-primary">Remover Pasta</a>
                    <a href="{{ route('storage.local.list.files.metadata') }}" class="btn btn-primary">Listar Ficheiros
                        com Metadatas</a>
                    <a href="{{ route('storage.local.list.for.download') }}" class="btn btn-primary">Download</a>

                </div>

                <hr>

            </div>

            <div>
                <p class="display-6">Upload de Arquivos</p>
                <form action="{{ route('storage.local.upload') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label for="arquivo" class="form-label">Arquivo</label>
                        <input type="file" class="form-control" id="arquivo" name="arquivo">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5">Enviar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

</x-main-layout>
