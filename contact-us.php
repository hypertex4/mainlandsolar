<?php include_once("inc/header.nav.php"); ?>
<main>
    <div id="contact-us-page">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="../">Home</a></li>
                    <li><a href="../">My Account</a></li>
                    <li>Profile</li>
                </ul>
                <div class="title-wrapper">
                    <hr class="my-0">
                    <h1 class="title mb-0">CONTACT US</h1>
                    <hr class="my-0">
                </div>
                <h2 class="aside mb-5">FOR MORE ENQUIRES ON INSTALLATION AND MAINTENANCE</h2>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <ul class="px-0 list-style-none bold-600">
                            <li>
                                <span>Email Address:</span>&nbsp;&nbsp;<span>support@mainlandsolar.com</span>
                            </li>
                            <li><span>Call:</span>&nbsp;&nbsp;<span>+2348099973409</span></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-7">
                        <form name="contactUs" id="contactUs">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="request">Service Requested</label>
                                    <select name="request" class="form-control" id="request">
                                        <option value=""></option>
                                        <option value="Energy Audit">Energy Audit</option>
                                        <option value="Product Sales">Product Sales</option>
                                        <option value="Product Delivery">Product Delivery</option>
                                        <option value="System Maintenance">System Maintenance</option>
                                        <option value="System Simulation">System Simulation</option>
                                        <option value="System Installation">System Installation</option>
                                        <option value="Consultation & Support">Consultation & Support</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="captcha_answer">Captcha. What is the answer to 8 X 9 = ?</label>
                                    <input type="number" class="form-control" name="captcha_answer" id="captcha_answer" placeholder="Answer">
                                    <input name="captcha_answer_raw" type="hidden" value="73">
                                </div>
                            </div>
                            <div id="response-alert" class="mb-3"></div>
                            <button type="submit" class="btn btn-white rounded-0 bold-600" id="contactUsBtn">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>