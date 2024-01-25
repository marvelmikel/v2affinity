<h1 class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700">
            <i class="voyager-company"></i>
            Company Information
        </h1>

        <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="panel-body">

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" style="color:black; font-weight:bolder;" value="{{ $companyData['company_name'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_address">Company Address</label>
                        <input type="tel" name="company_address" id="company_address" style="color:black; font-weight:bolder;" value="{{ $companyData['company_address'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_phone">Company Phone Number</label>
                        <input type="tel" name="company_phone" id="company_phone" style="color:black; font-weight:bolder;" value="{{ $companyData['company_phone'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_email">Company Email</label>
                        <input type="tel" name="company_email" id="company_email" style="color:black; font-weight:bolder;" value="{{ $companyData['company_email'] }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="company_number">Company Reg Number</label>
                        <input type="tel" name="company_number" id="company_number" style="color:black; font-weight:bolder;" value="{{ $companyData['company_number'] }}" class="form-control" required>
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="font-bold mb-2 text-2xl lg:text-2xl text-slate-700" for="terms_conditions" style="font-weight:bolder;">
                            <h3>Terms & Conditions</h3>
                        </label>
                        <input type="hidden" name="terms_conditions" id="terms_conditions" class="form-control richTextBox" style="font-size:20px;" value="{{ $companyData['terms_conditions'] }}">
                        <trix-editor input="terms_conditions" class="trix-content"></trix-editor>

                </div>
            </div>

            <button type="submit" class="border-2 border-main-color text-main-color rounded font-semibold hover:bg-main-color hover:text-white duration-300 transition ease-in-out px-5 py-1.5 livvic-font-semibold px-9 py-1">Update Info</button>

        </form>