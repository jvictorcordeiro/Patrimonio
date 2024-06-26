@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/layouts/searchbar.css">

    <style>
        label{
            color: #1A2876;
        }
        .red-asterisk {
            color: #AA2E2E;
        }
    </style>
@endpush

@section('content')
    @include('layouts.components.searchbar', [
        'title' => 'Patrimônios > Cadastrar',
        'titleLink' => Route('patrimonio.index'),
    ])

    <div>
        <form action="{{ route('patrimonio.store') }}" method="post">
            @csrf

            <div class="row mb-3">
                <div class="form-group col-md-4">
                    <label for="nome" class="form-label fw-bold">Nome do
                        item: <span class="red-asterisk">*</span></label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" value="{{old('nome')}}">

                    @error('nome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="descricao" class="form-label fw-bold">Descrição: <span
                            class="red-asterisk">*</span></label>
                    <textarea type="text" class="form-control @error('descricao') is-invalid @enderror" rows="1" name="descricao" id="descricao">{{old('descricao')}}</textarea>

                    @error('descricao')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="origem" class="form-label fw-bold">Origem: <span
                            class="red-asterisk">*</span></label>
                    <select class="form-select @error('origem_id') is-invalid @enderror" aria-label="Selecione uma Origem" id="origem_id"
                        name="origem_id">
                        <option selected disabled value="">Selecione uma Origem</option>
                        @foreach ($origens as $origem)
                            <option value="{{ $origem->id }}" @if(old('origem_id') == $origem->id) selected @endif>{{ $origem->nome }}</option>
                        @endforeach
                    </select>

                    @error('origem_id')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col">
                    <label for="classificacao" class="form-label fw-bold">Classificação: <span
                        class="red-asterisk">*</span></label>
                    <select class="form-select @error('classificacao') is-invalid @enderror" name="classificacao" id="classificacao">
                        <option selected disabled value="">Selecione uma classificação</option>
                        @foreach ($classificacoes as $classificacao)
                            <option value="{{$classificacao->id}}" @if(old('classificacao') == $classificacao->id) selected @endif>{{$classificacao->nome}}</option>
                        @endforeach
                    </select>

                    @error('classificacao')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="subgrupo_id" class="form-label fw-bold">Subgrupo: <span
                            class="red-asterisk">*</span></label>
                    <select class="form-select @error('subgrupo_id') is-invalid @enderror" aria-label="Selecione uma classificação"
                        id="subgrupo_id" name="subgrupo_id">
                        <option selected disabled value="">Selecione um subgrupo</option>
                        @foreach ($subgrupos as $subgrupo)
                            <option value="{{ $subgrupo->id }}"  @if(old('subgrupo_id') == $subgrupo->id) selected @endif>{{ $subgrupo->nome }}</option>
                        @endforeach
                    </select>

                    @error('subgrupo_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="situacao" class="form-label fw-bold">Situação: <span
                            class="red-asterisk">*</span></label>
                    <select class="form-select @error('situacao_id') is-invalid @enderror" aria-label="Selecione uma Situação" id="situacao_id"
                        name="situacao_id">
                        <option selected disabled value="">Selecione uma Situação</option>
                        @foreach ($situacoes as $situacao)
                            <option value="{{ $situacao->id }}"  @if(old('situacao_id') == $situacao->id) selected @endif>{{ $situacao->nome }}</option>
                        @endforeach
                    </select>

                    @error('situacao_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="form-group col">
                    <label for="predio" class="form-label fw-bold">Prédio: <span
                            class="red-asterisk">*</span></label>
                    <select class="form-select @error('predio_id') is-invalid @enderror" onchange="filtrarSalas()"
                        aria-label="Selecione um prédio" id="predio_id" name="predio_id" >
                        <option selected disabled value="">Selecione um prédio</option>
                        @foreach ($predios as $predio)
                            <option value="{{ $predio->id }}"  @if(old('predio_id') == $predio->id) selected @endif>{{ $predio->nome }}</option>
                        @endforeach
                    </select>

                    @error('predio_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="unidade" class="form-label fw-bold">Unidade Administrativa: <span class="red-asterisk">*</span></label>
                    <select class="form-select @error('unidade_admin_id') is-invalid @enderror" aria-label="Selecione uma unidade" id="unidade_admin_id" name="unidade_admin_id" >
                        <option selected disabled value="">Selecione uma Unidade Administrativa</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}"  @if(old('unidade_admin_id') == $unidade->id) selected @endif>{{ $unidade->nome }}</option>
                        @endforeach
                    </select>

                    @error('unidade_admin_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="sala" class="form-label fw-bold">Sala: <span
                            class="red-asterisk">*</span></label>
                    <select class="form-select @error('sala_id') is-invalid @enderror" aria-label="Selecione uma sala" id="sala_id"
                        name="sala_id" >
                        <option selected disabled value="">Selecione uma sala</option>
                    </select>

                    @error('sala_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

            </div>

            <div class="row mb-3">
                <div class="form-group col">
                    <label for="data_compra" class="form-label fw-bold">Data da Nota Fiscal: <span
                            class="red-asterisk">*</span></label>
                    <input type="date" class="form-control @error('data_compra') is-invalid @enderror" name="data_compra" id="data_compra" value="{{old('data_compra')}}">

                    @error('data_compra')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="data_incorporacao" class="form-label fw-bold">Data de Incorporação: <span
                            class="red-asterisk">*</span></label>
                    <input type="date" class="form-control @error('data_incorporacao') is-invalid @enderror" name="data_incorporacao" id="data_incorporacao" value="{{old('data_incorporacao')}}">

                    @error('data_incorporacao')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="valor" class="form-label fw-bold">Valor do item:</label>
                    <input type="number" step="0.01" class="form-control @error('valor') is-invalid @enderror" name="valor" id="valor" value="{{old('valor')}}">

                    @error('valor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="conta_contabil" class="form-label fw-bold">Conta contábil: <span
                            class="red-asterisk">*</span></label>
                    <input type="text" class="form-control @error('conta_contabil') is-invalid @enderror" name="conta_contabil" id="conta_contabil" value="{{old('conta_contabil')}}">

                    @error('conta_contabil')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="empenho" class="form-label fw-bold">Empenho: <span
                            class="red-asterisk">*</span></label>
                    <input type="text" class="form-control @error('empenho') is-invalid @enderror" name="empenho" id="empenho" value="{{old('empenho')}}">

                    @error('empenho')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                    <label for="nota_fiscal" class="form-label fw-bold">Nota fiscal: <span
                            class="red-asterisk">*</span></label>
                    <input type="text" class="form-control @error('nota_fiscal') is-invalid @enderror" name="nota_fiscal" id="nota_fiscal" value="{{old('nota_fiscal')}}">

                    @error('nota_fiscal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                @if(Auth::user()->hasAnyRoles(['Administrador']))
                    <div class="col">
                        <label for="processo_licitacao" class="form-label fw-bold">Processo de licitação:</label>
                        <input type="number" id="processo_licitacao" name="processo_licitacao" class="form-control @error('processo_licitacao') is-invalid @enderror" value="{{old('processo_licitacao')}}">

                        @error('processo_licitacao')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label for="servidor" class="form-label fw-bold">Servidor: <span
                                class="red-asterisk">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror" aria-label="Selecione um servidor" id="user_id"
                            name="user_id">
                            <option selected value="">Selecione um servidor</option>
                            @foreach ($servidores as $servidor)
                                <option value="{{ $servidor->id }}"  @if(old('user_id') == $servidor->id) selected @endif>{{ $servidor->name }}</option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
            </div>
                <div class="col">
                    <label for="observacao" class="form-label fw-bold">Observações pertinentes a este
                        patrimônio:</label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="4">{{old('observacao')}}</textarea>
                </div>
            </div>

            <div class="row justify-content-center mb-5 mt-5">
                <div class="col-auto">
                    <button class="btn btn-blue btn-lg" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Convertendo os dados PHP para JavaScript
        var predios = {!! json_encode($predios) !!};

        function filtrarSalas() {
            // Obter o valor selecionado do prédio
            var predioSelecionadoId = document.getElementById("predio_id").value;

            // Encontrar o prédio selecionado nos dados carregados
            var predioSelecionado = predios.find(function(predio) {
                return predio.id == predioSelecionadoId;
            });

            // Obter as salas do prédio selecionado
            var salasDoPredio = predioSelecionado ? predioSelecionado.salas : [];

            // Atualizar as opções do select de salas
            var selectSala = document.getElementById("sala_id");

            // Limpar as opções existentes
            selectSala.innerHTML = "";

            // Adicionar as novas opções
            for (var i = 0; i < salasDoPredio.length; i++) {
                var option = document.createElement("option");
                option.text = salasDoPredio[i].nome;
                option.value = salasDoPredio[i].id;
                selectSala.add(option);
            }
        }

        function trocarRequired(required) {
            campos = $('#empenho, #nota_fiscal, #data_compra');

            $(campos).each(function () {
                $(this).prop('required', required);
                asterisk = $(this).prev('label').find('span.red-asterisk');
                required ? asterisk.show() : asterisk.hide();
            });
        }

        $('#origem_id').on('change', function () {
            required = $(this).find('option:selected').text() == "Licitação";
            trocarRequired(required);
        });

        $(document).ready(function () {
            filtrarSalas();
        });
        </script>
@endpush
