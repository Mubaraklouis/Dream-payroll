<x-admin-layout>
    <x-slot:title>Frequently asked questions</x-slot:title>
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>Frequently Asked Questions</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Frequently Asked Questions</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section faq">
        <div class="row">
          <div class="col-lg-6">
  
            <div class="card basic">
              <div class="card-body">
                <h5 class="card-title">Basic Questions</h5>
  
                <div>
                  <h6>1. How do I add a new employee to the payroll system?</h6>
                  <p>Log in to the admin portal of the payroll system. <br>
                    Go to the "Employees" menu. <br>
                    Click on "Add Employee" and fill in the required details. <br>
                    Such as the Names and the Email <br>
                    Save the information to add the new employee by clicking on "Add employee button". <br>
                    An email will be sent to employee contain their account creation code. <br>
                    The account creation code can also be seen in this "Employee creation page" under "Accounts not validated" section.
                  </p>
                </div>
  
                <div class="pt-2">
                  <h6>2. How can I generate Paysheets for all the employees?</h6>
                  <p>Log in to the admin portal. <br>
                    Navigate to the "Salary input" section under "Components" menu. <br>
                    Click on "Generate all Pay Sheets" button <br>
                    In the viewing page displayed, you can choose to "Print all pay sheets" or "Send them to all the employees"</p>
                </div>
  
                <div class="pt-2">
                  <h6>3. How do I update employee salary details?</h6>
                  <p>Log in to the admin portal. <br>
                    Go to the "Employee List" section under "dashboard" menu. <br>
                    Select the employee whose salary details you want to update. <br>
                    Make the necessary changes in the salary section and save the updates.</p>
                </div>
  
              </div>
            </div>
  
            
  
          </div>
  
          <div class="col-lg-6">
  
            <!-- F.A.Q Group 2 -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Admin User Manual</h5>
  
                <div class="accordion accordion-flush" id="faq-group-2">
  
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" data-bs-target="#faqsTwo-1" type="button" data-bs-toggle="collapse">
                        How do I update employee information details?
                      </button>
                    </h2>
                    <div id="faqsTwo-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                      <div class="accordion-body">
                        Log in to the admin portal. <br>
                    Go to the "Employee List" section under "dashboard" menu. <br>
                    Select the employee whose information details you want to update. <br>
                    Make the necessary changes in the salary section and save the updates.
                      </div>
                    </div>
                  </div>
  
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" data-bs-target="#faqsTwo-2" type="button" data-bs-toggle="collapse">
                        How can I process payroll for the month?
                      </button>
                    </h2>
                    <div id="faqsTwo-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                      <div class="accordion-body">
                        Log in to the admin portal. <br>
                        Navigate to the "Employee lists" section under dashboard menu. <br>
                        Review the employee details and salary components by clicking on the employee or filtering search using the search button in the list viewing. <br>
                        Click on "Save input" to calculate salaries and save them. <br>
                        Then click on "Send Pay Sheet to the Employee" to send the paysheet to the employee <br>
                        Click on "Generate Pay Sheet" to print it.
                      </div>
                    </div>
                  </div>
  
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" data-bs-target="#faqsTwo-3" type="button" data-bs-toggle="collapse">
                        How do I add salary inputs for calculation?
                      </button>
                    </h2>
                    <div id="faqsTwo-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                      <div class="accordion-body">
                        Log in to the admin portal. <br>
                        Go to the "Salary Inputs" section under "Components" menu. <br>
                        Two sections will be display for Gross salary and Deduction calculations.<br>
                        "Add input" by filling the required field such as the name and the price. <br>
                        Options for editing and deleting are also displayed in the "inputs list" tab.
                      </div>
                    </div>
                  </div>
  
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" data-bs-target="#faqsTwo-4" type="button" data-bs-toggle="collapse">
                        How do I respond to requests from employees?
                      </button>
                    </h2>
                    <div id="faqsTwo-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                      <div class="accordion-body">
                        Log in to the admin portal. <br>
                        Go to the "Requests" section under "Components" menu. <br>
                        Under "Internal Employee requests" find all requests from employees <br>
                        Respond to request by typing and marking as read <br>
                        <br>
                        Find also account creation requests from employees to be approved.
                      </div>
                    </div>
                  </div>
  
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" data-bs-target="#faqsTwo-5" type="button" data-bs-toggle="collapse">
                        How do I send news or announcements?
                      </button>
                    </h2>
                    <div id="faqsTwo-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                      <div class="accordion-body">
                        Log in to the payroll system. <br>
                        Go to the "News" menu. <br>
                        Fill the announcement with necessary fields or attach a document if needed <br>
                        Send Message to all Employees.
                      </div>
                    </div>
                  </div>
  
                </div>
  
              </div>
            </div><!-- End F.A.Q Group 2 -->
  
            
  
          </div>
  
        </div>
      </section>
  
    </main><!-- End #main -->
</x-admin-layout>
