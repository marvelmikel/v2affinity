<h1 class="page-title">
            <i class="voyager-company"></i>
            Company Information
        </h1>
        <div class="panel-body">

            <div class="form-group row">
                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ $companyData['company_name'] }}" class="form-control" readonly style="background-color: white; color:black;font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_address">Company Address</label>
                    <input type="tel" name="company_address" id="company_address" value="{{ $companyData['company_address'] }}" class="form-control" readonly style="background-color: white;color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_phone">Company Phone Number</label>
                    <input type="tel" name="company_phone" id="company_phone" value="{{ $companyData['company_phone'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_email">Company Email</label>
                    <input type="tel" name="company_email" id="company_email" value="{{ $companyData['company_email'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>

                <div class="col-md-4">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_number">Company Reg Number</label>
                    <input type="tel" name="company_number" id="company_number" value="{{ $companyData['company_number'] }}" class="form-control" readonly style="background-color: white; color:black; font-weight:bolder;">
                </div>


            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="terms_conditions" style="font-weight:bolder;">
                        <h1>Terms & Conditions</h1>
                    </label>
                    <br>
                    <p style="background-color: white; color:black; font-weight:bolder; font-size:20px; height:100px">
                        {{ strip_tags ($companyData['terms_conditions']) }}
                    </p>
                </div>

            </div>
        </div>