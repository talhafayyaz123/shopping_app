 @if( count($adddress) <5)
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{!! url('/add-address') !!}" class="login sign-in btn btn-dark btn-rounded btn-sm mb-4">Add</a>
                                </div>
                            </div>
                            @endif

                           
                         
                                
                               
                       <table class="shop-table account-orders-table mb-6">
                         <div class="alert alert-success user_adress_popup" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong></strong>
                        </div>

                                <thead>
                                <tr>
                                    <th class="order-id">Address</th>
                                    <th class="order-date">Country</th>
                                    <th class="order-status">City</th>
                                    <th class="order-total">Zip</th>
                                    <th class="order-total">Status</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($adddress)>0)
                                   @foreach($adddress as $address)
                                <tr>
                                    <td class="order-id">{{ $address->address }}</td>
                                    <td class="order-date">{{ $address->country }}</td>
                                    <td class="order-status">{{ $address->city }}</td>
                                    <td class="order-status">{{ $address->zip }}</td>
                                    <td class="order-status">{{ $address->status }}</td>
                                    <!-- <td class="order-action">
                                    <a href="#"
                                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">Edit</a>
                                    </td> -->

                                    <td class="order-action">

                                    <a onclick="change_address_status({{$address->id}},'{{$address->status}}')"
                                           class="btn btn-outline btn-default btn-block btn-sm btn-rounded">
                                      @if($address->status=='Active')

                                      Inactive
                                       @else
                                        Active
                                       @endif

                                   </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                 <tr>
                                     <td class="order-id">No Address Found.</td>
                                 </tr>

                                @endif
                                </tbody>
                            </table>