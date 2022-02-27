<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                <p class="active">New Address</a>    
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
                <span id="validation_errors" class="error invalid-feedback" style="display: none"></span>
                <form id="new_address_form" method="post" action="{{route('save_address')}}">
                @csrf
                <div class="form-group">
                    <label>Address*</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>
                <div class="form-group mb-0">
                    <label>City*</label>
                    <input type="text" class="form-control" name="city" id="city" required>
                </div>

                 <div class="form-group mb-0">
                    <label>Zip*</label>
                    <input type="text" class="form-control" name="zip" id="zip" required>
                </div>
               
                <div class="form-group">
                        <label>Country:</label>
                        <select class="form-control" name="country" id="country" required>
                            <option value="Pakistan">Pakistan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="new_address_btn">Save</button>
                </form>
            </div>
           
        </div>
      
    </div>
</div>
