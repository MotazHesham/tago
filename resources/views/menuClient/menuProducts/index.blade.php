@extends('layouts.menuClient')
@section('styles')
    <style>
        .table-users {
            max-width: calc(100% - 2em);
            margin: 1em auto;
            overflow: hidden;
            width: 100%;
        }

        table {
            width: 100%;
        }

        table td,
        table th {
            color: #2b686e;
            padding: 10px;
        }

        table td {
            vertical-align: middle;
        }

        table td:last-child {
            font-size: 0.95em;
            line-height: 1.4;
            text-align: left;
        }

        table th {
            background-color: #daeff1;
            font-weight: 300;
        }

        table tr:nth-child(2n) {
            background-color: white;
        }

        table tr:nth-child(2n+1) {
            background-color: #edf7f8;
        }

        @media screen and (max-width: 700px) {

            table,
            tr,
            td {
                display: block;
            }

            td:first-child {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 100px;
            }

            td:not(:first-child) {
                clear: both;
                margin-left: 100px;
                padding: 4px 20px 4px 90px;
                position: relative;
                text-align: left;
            }

            td:not(:first-child):before {
                color: #91ced4;
                content: "";
                display: block;
                left: 0;
                position: absolute;
            }

            td:nth-child(2):before {
                content: "Name:";
            }

            td:nth-child(3):before {
                content: "Price:";
            }

            td:nth-child(4):before {
                content: "Description:";
            }

            td:nth-child(5):before {
                content: "Banner:";
            }
            td:nth-child(6):before {
                content: "Category:";
            }

            tr {
                padding: 10px 0;
                position: relative;
            }

            tr:first-child {
                display: none;
            }
        }

        @media screen and (max-width: 500px) {
            .header {
                background-color: transparent;
                color: white;
                font-size: 2em;
                font-weight: 700;
                padding: 0;
                text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
            }

            img {
                border: 3px solid;
                border-color: #daeff1;
                height: 100px;
                margin: 0.5rem 0;
                width: 100px;
            }

            td:first-child {
                background-color: #c8e7ea;
                border-bottom: 1px solid #91ced4;
                border-radius: 10px 10px 0 0;
                position: relative;
                top: 0;
                transform: translateY(0);
                width: 100%;
            }

            td:not(:first-child) {
                margin: 0;
                padding: 5px 1em;
                width: 100%;
            }

            td:not(:first-child):before {
                font-size: 0.8em;
                padding-top: 0.3em;
                position: relative;
            }

            td:last-child {
                padding-bottom: 1rem !important;
            }

            tr {
                background-color: white !important;
                border: 1px solid #6cbec6;
                border-radius: 10px;
                box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);
                margin: 0.5rem 0;
                padding: 0;
            }

            .table-users {
                border: none;
                box-shadow: none;
                overflow: visible;
            }
        }
        .ck-editor__editable,
        textarea {
            min-height: 150px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="table-users">
            <div class="header">
                <b>Products</b>
                <div style="float: right;">
                    <button class="btn btn-light" style="color:grey" onclick="add_product()">Add new +</button>
                    <div style="clear: both"></div>
                </div>
            </div>  
            
            <div class='card-body'>
                <div class="row">
                    <div class="col-md-12">
                        <table cellspacing="0">
                            <tr>
                                <th>id</th>
                                <th>Name</th> 
                                <th>Price</th> 
                                <th>Description</th> 
                                <th>banner</th>
                                <th>Category</th> 
                                <th> </th>
                            </tr>

                            @forelse($products as $product)
                                <tr data-entry-id="{{ $product->id }}">
                                    <td>{{ $product->id ?? '' }}</td>
                                    <td>{{ $product->name ?? '' }}</td> 
                                    <td>{{ $product->price ?? '' }}</td>  
                                    <td>{{ $product->description ?? '' }}</td>   
                                    <td> 
                                        @if($product->banner)
                                            <a href="{{ $product->banner->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $product->banner->getUrl('preview') }}">
                                            </a>
                                        @endif
                                    </td>   
                                    <td>{{ $product->menu_category->name ?? '' }}</td>  
                                    <td> 
                                        <a class="btn btn-outline-primary btn-sm" onclick="edit_product('{{ route('menuClient.menu-products.edit', $product->id) }}')">{{ trans('global.edit') }}</a> 
                                        <form action="{{ route('menuClient.menu-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-outline-danger btn-sm" value="{{ trans('global.delete') }}">
                                        </form>
                                    </td>
                                </tr> 
                            @empty
                                <tr>
                                    <td colspan="5"> No Products Added Yet</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    
    
@endsection

@section('scripts')
    <script>
        function add_product(){ 
            $.get('{{ route('menuClient.menu-products.create') }}', function(data) {
                $('#AjaxModal .modal-dialog').html(null);
                $('#AjaxModal').modal('show');
                $('#AjaxModal .modal-dialog').html(data); 
            });
        }
        function edit_product(route){  
            $.ajax({
                url: route, 
                method: 'GET',
                success: function(data) {
                    $('#AjaxModal .modal-dialog').html(null);
                    $('#AjaxModal').modal('show');
                    $('#AjaxModal .modal-dialog').html(data); 
                }
            });
        }
    </script>
@endsection
