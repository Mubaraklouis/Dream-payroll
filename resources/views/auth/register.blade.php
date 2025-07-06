<x-guest-layout>
    <x-slot:title>Create your account</x-slot:title>
    
    <section class="login-section">

        <div class="login-container">

            <div class="login-welcome-bloc">
                <p>Finally, we want to know you more </p>
                <h4>PLEASE COMPLETE THIS FORM</h4>
                <h6></h6>
            </div>

            <div class="login-form">
                <h5>Emloyee informations</h5>
                <form class="form-scrolling" action="{{route("register", ["employee" => $employee, "code" => $employee->otp ])}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="personnal-informations">
                        <h6><span>i.</span> Personnal informations</h6>
                        <div>
                            <input type="text" name="name" value="{{ old("name", $employee->name) }}" placeholder="Your names">
                            @error("name")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old("email", $employee->email) }}" placeholder="Email address">
                            @error("email")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="address" value="{{ old("address") }}" placeholder="Current address">
                            @error("address")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="phone_number" value="{{ old("phone_number") }}" placeholder="Phone number">
                            @error("phone_number")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="date" name="birth_date" value="{{ old("birth_date") }}" placeholder="Date of your birth">
                            @error("birth_date")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <p class="profile-paragraph">Select your profile picture</p>
                            <input class="file-input" type="file" name="image" value="{{old("image")}}">
                            @error("image")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div style="color:initial;">
                            <p class="profile-paragraph">Do you have dependents?</p>
                            <div class="dependents-options" style="display: fle; gap: 10px;">
                                <input type="radio" id="has_dependents_yes" name="has_dependents" value="1" @checked(old('has_dependents') == '1')>
                                <label for="has_dependents_yes" class="dependents-option">Yes</label>

                                <input type="radio" id="has_dependents_no" name="has_dependents" value="0" @checked(old('has_dependents') == '0')>
                                <label for="has_dependents_no" class="dependents-option">No</label>
                            </div>
                            @error('has_dependents')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div id="dependents" style="display: none;">
                            <p class="profile-paragraph">Please specify your dependents:</p>
                            <textarea name="dependents" rows="4" placeholder="e.g. Wife, 2 children">{{ old('dependents') }}</textarea>
                            @error('dependents')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <script>
                            document.querySelectorAll('input[name="has_dependents"]').forEach(function(element) {
                                element.addEventListener('change', function() {
                                    var dependentsDetails = document.getElementById('dependents_details');
                                    if (this.value == '1') {
                                        dependentsDetails.style.display = 'block';
                                    } else {
                                        dependentsDetails.style.display = 'none';
                                    }
                                });
                            });
                        
                            // Ensure the dependents details field is displayed if previously checked
                            if (document.querySelector('input[name="has_dependents"]:checked') && document.querySelector('input[name="has_dependents"]:checked').value == '1') {
                                document.getElementById('dependents_details').style.display = 'block';
                            }
                        </script>
                    </div>

                    <div class="job-informations">
                        <h6><span>ii.</span> Job informations</h6>
                        <div>
                            <input type="number" name="reg_number" value="{{old("reg_number")}}" placeholder="# Reg number">
                            @error("reg_number")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="job_title" value="{{ old("job_title") }}" placeholder="Your job title">
                            @error("job_title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="department" value="{{ old("department") }}" placeholder="Your department">
                            @error("department")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="base_location" value="{{ old("base_location") }}" placeholder="Base location">
                            @error("base_location")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <select name="contract_type" id="contractType">
                                <option value="">Select type of contract...</option>
                                <option value="Fixed-term contract" @selected(old("contract_type") == "Fixed-term contract") >Fixed-term contract</option>
                                <option value="Permanent contract" @selected(old("contract_type") == "Permanent contract") >Permanent contract</option>
                            </select>t
                            @error("contract_type")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <p class="profile-paragraph">If on previous question you chose Fixed-term contract, then enter the number of months of your contract</p>
                            <input type="number" name="contract_duration" value="{{ old("contract_duration") }}" placeholder="Number of months">
                            @error("contract_duration")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            
                            <p class="profile-paragraph">And the date you started</p>
                            <input type="date" name="contract_start_date">
                            @error("contract_start_date")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            

                        </div>
                    </div>

                    <div class="banking-informations">
                        <h6><span>iii.</span> Banking informations</h6>
                        <div>
                            <input type="text" name="bank_name" value="{{ old("bank_name") }}" placeholder="Bank name">
                            @error("bank_name")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="bank_account_name" value="{{ old("bank_account_name") }}" placeholder="Your bank account name">
                            @error("bank_account_name")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="bank_account_number" value="{{ old("banck_account_number") }}" placeholder="Your bank account number">
                            @error("bank_account_number")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="user-informations">
                        <h6><span>iv.</span> Authentifications</h6>
                        {{-- <div>
                            <input type="text" na placeholder="Enter your username">
                        </div> --}}
                        <div>
                            <input type="password" name="password" autocomplete="new-password" placeholder="Create your password">
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Confirm your password">
                            @error("password")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-submit">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>

        </div>

    </section>
</x-guest-layout>
