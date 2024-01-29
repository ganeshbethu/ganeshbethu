<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{url('addsale')}}" method="POST" id="sales-form">
                        @csrf
                        <div class="row">
                            <div>
                                <dl>
                                    <dt>Product</dt>
                                    <dd><select name="product" id="product" onchange="getClearFieds()">
                                            @foreach($data['products'] as $product)
                                            <option value="{{$product->id}}" data-value="{{$product->margin}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select></dd>
                                </dl>
                            </div>
                            <div>
                                <dl>
                                    <dt>Quantity</dt>
                                    <dd><input type="text" size="7" id="quantity" name="quantity" onblur="getSellingPrice()" required /></dd>
                                </dl>
                            </div>
                            <div>
                                <dl>
                                    <dt>Unit Cost($)</dt>
                                    <dd><input type="text" size="7" id="up" name="up" onblur="getSellingPrice()" required /></dd>
                                </dl>
                            </div>
                            <div>
                                <dl>
                                    <dt>Selling Price</dt>
                                    <dd><input type="text" id="sp" style="border:none" id="sp" name="sp" required /></dd>
                                </dl>
                            </div>
                            <div>
                                <dt>&nbsp;</dt>
                                <dd>
                                    <button type="submit" class="btn" onclick="getValues()">Record Sale</button>
                                </dd>
                            </div>
                        </div>
                    </form>
                    <div class="py-12">
                        <h1 class="previous-text">Previous Sales </h1>
                        <table class="outline">
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Unit Price
                                </th>
                                <th>
                                    Selling Price
                                </th>
                                <th>
                                    Sold at
                                </th>
                            </tr>
                            <tbody id="content">
                                @foreach($data['sales'] as $sale)
                                <tr>
                                    <td> {{$sale->product->product_name}}</td>
                                    <td>{{$sale->quantity}} </td>
                                    <td>{{$sale->cost}} </td>
                                    <td>{{$sale->sellingprice}} </td>
                                    <td>{{$sale->created_at}} </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
        <script>
            function getSellingPrice() {
                $("#sales-form").validate();
                var up = ($('#up').val());
                var q = ($('#quantity').val());
                var cost = up * q;
                var shippingCost = 10;
                if (cost) {
                    var margin = $('#product').find(':selected').attr("data-value")
                    var sp = cost / (1 - (margin / 100)) + shippingCost;
                    $('#sp').val(sp.toFixed(2));
                }
            }

            function getClearFieds() {
                var up = ($('#up').val(''));
                var q = ($('#quantity').val(''));
                $('#sp').val('');
            }
        </script>
</x-app-layout>