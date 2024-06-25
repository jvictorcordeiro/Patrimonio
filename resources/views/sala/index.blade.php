@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/layouts/searchbar.css">
    <link rel="stylesheet" href="/css/layouts/table.css">
@endpush

@section('content')
    @if (isset($predio))
        @include('layouts.components.searchbar', [
            'title' => 'Prédios > Salas',
            'titleLink' => Route('predio.index', ['predio_id' => $predio->id]),
            'addButtonModal' => 'cadastrarSalaModal',
            'searchForm' => route('sala.buscar'),
        ])
    @else
        @include('layouts.components.searchbar', [
            'title' => 'Salas',
            'searchForm' => route('sala.buscar'),
        ]);
    @endif

    <div class="col-md-10 mx-auto">
        @include('layouts.components.table', [
            'header' => ['ID', 'Nome', 'Telefone', 'Ações'],
            'content' => [
                $salas->pluck('id'),
                $salas->pluck('nome'),
                $salas->pluck('telefone'),
            ],
            'acoes' => [
                [
                    'link' => 'sala.edit',
                    'param' => 'sala_id',
                    'img' => asset('/images/pencil.png'),
                    'type' => 'edit',
                ],
                [
                    'link' => 'sala.delete',
                    'param' => 'sala_id',
                    'img' => asset('/images/delete.png'),
                    'type' => 'delete',
                ],
            ],
        ])

        <div class="d-flex justify-content-center">
            {{ $salas->links('pagination::bootstrap-4') }}
        </div>
    </div>

    @include('layouts.components.modais.modal', [
        'modalId' => 'cadastrarSalaModal',
        'modalTitle' => 'Cadastrar Sala',
        'formAction' => route('sala.store'),
        'type' => ('create'),
        'fields' => [
            ['type' => 'hidden', 'name' => 'predio_id', 'id' => 'predio_id', 'value' => $predio->id],
            ['type' => 'text', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome:'],
            ['name' => 'telefone', 'id' => 'telefone', 'type' => 'text' , 'label' => 'Telefone:'],
        ]
    ])

    @include('layouts.components.modais.modal', [
        'modalId' => 'editarSalaModal',
        'modalTitle' => 'Editar Sala',
        'formAction' => route('sala.update', ['sala_id' => ':id']),
        'type' => ('edit'),
        'fields' => [
            ['type' => 'hidden', 'name' => 'predio_id', 'id' => 'predio_id', 'value' => $predio->id],
            ['type' => 'text', 'name' => 'nome', 'id' => 'nome', 'label' => 'Nome:'],
            ['name' => 'telefone', 'id' => 'telefone', 'type' => 'text' , 'label' => 'Telefone:'],
        ]
    ])

    @include('layouts.components.modais.modal_delete', [
        'modalId' => 'deleteConfirmationModal',
        'modalTitle' => 'Tem certeza que deseja apagar esta Sala?',
        'route' => route('sala.delete', ['sala_id' => 'id']),
    ])

@endsection

@push('scripts')
    <script>
        const salaDeleteRoute = "http://127.0.0.1:8000/sala/sala_id/delete";
        const salaUpdateRoute = "{{ route('sala.update', ['sala_id' => ':id']) }}";
        var SalaId = 0;
        const salasNome = {!! json_encode($salas->pluck('nome', 'id')) !!};
        const salasTelefone = {!! json_encode($salas->pluck('telefone', 'id')) !!};

        $(document).ready(function () {
            $('#editarSalaModal').on('show.bs.modal', function(event) {
                var formAction = salaUpdateRoute.replace(':id', salaId);
                $(this).find('form').attr('action', formAction);
                $('#nome-edit').val(salasNome[salaId]);
                $('#telefone-edit').val(salasTelefone[salaId]);

            });
        });

        function openEditModal(id) {
            salaId = id;
            $('#editarSalaModal').modal('show');
        }

        function openDeleteModal(id) {
            SalaId = id;
            $('#deleteConfirmationModal').modal('show');
        }

        $(document).ready(function () {
            $('#deleteConfirmationModal').on('show.bs.modal', function(event) {
                var formAction = salaDeleteRoute.replace('sala_id', SalaId);
                $(this).find('form').attr('action', formAction);
            });
        });
    </script>
@endpush
