<?php include_once("inc/header.nav.php"); ?>
<div id="load-system-questionnaire-page">
    <div class="bg-white">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="services">Support and services</a></li>
                <li>Load/System Questionnaire</li>
            </ul>
            <div class="title-wrapper">
                <hr class="my-0">
                <h1 class="title mb-0 uppercase">Load/System Questionnaire</h1>
                <hr class="my-0">
            </div>
            <section class="py-4" id="step-1">
                <div id="progress-bar">
                    <div id="reader" class="default_width"></div>
                    <div class="inner">
                        <div class="label-wrapper">
                            <div class="label mb-3">CATEGORY</div>
                            <div class="bulb first active"></div>
                        </div>
                        <div class="label-wrapper">
                            <div class="label mb-3">CALCULATE ENERGY NEEDED FOR YOUR PRODUCT</div>
                            <div class="bulb second"></div>
                        </div>
                    </div>
                </div>
                <div id="form-step-1">
                    <div class="inner">
                        <form method="post" action="system-questionnaire-step-two">
                            <div class="form_step slidePage">
                                <div class="step-inner">
                                    <div class="card border-0 rounded-0">
                                        <div class="card-body">
                                            <fieldset>
                                                <legend>I want to install Solar System as </legend>
                                                <div class="form-group">
                                                    <div class="custom-check-wrapper">
                                                        <input type="radio" name="installation-choice" id="off-grid" class="check_rej" value="off-grid" checked>
                                                        <label for="off-grid" class="d-flex flex-wrap">
                                                            <span class="fake-radio custom_checkbox checkbox tick"></span>
                                                            <div class="bold-600">1. Off-grid</div>
                                                            <aside>
                                                                This option independently powers your electrical loads using solely energy from the sun.</br>
																<small>(Note that in the event of very cloudy weather for a prolonged period, the system may need 
																grid or generator support.)</small>
                                                            </aside>
                                                        </label>
                                                    </div>
                                                </div>
<!--                                                <div class="form-group">-->
<!--                                                    <div class="custom-check-wrapper">-->
<!--                                                        <input type="radio" name="installation-choice" id="energy-saving-bill-offset-system" value="energy-saving" class="check_rej">-->
<!--                                                        <label for="energy-saving-bill-offset-system" class="d-flex flex-wrap">-->
<!--                                                            <span class="fake-radio custom_checkbox checkbox tick"></span>-->
<!--                                                            <div class="bold-600">2. Energy saving/Bill offset system</div>-->
<!--                                                            <aside>-->
<!--                                                                (Lorem ipsum dolor sit amet consectetur adipisicing-->
<!--                                                                elit. Expedita, eos quae voluptatem odio a omnis-->
<!--                                                                architecto mollitia repellat non sit.)-->
<!--                                                            </aside>-->
<!--                                                        </label>-->
<!--                                                    </div>-->
<!--                                                </div>-->
                                                <div class="form-group">
                                                    <div class="custom-check-wrapper">
                                                        <input type="radio" name="installation-choice" id="uninterrupted-power-supply" value="ups" class="check_rej">
                                                        <label for="uninterrupted-power-supply" class="d-flex flex-wrap">
                                                            <span class="fake-radio custom_checkbox checkbox tick"></span>
                                                            <div class="bold-600">2. Uninterrupted power supply</div>
                                                            <aside>
                                                                The UPS system ensures a continued supply of power to electrical loads in an event of grid/generator 
																power failure over the defined period of time.</br>
																<small>(Note that grid/generator power must be restored within the defined backup time to prevent interruption 
																of power to the load.)</small>
                                                            </aside>
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 step-footer">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-white px-5 rounded-0 step-1-btn">NEXT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </div>


    </div>
</div>
<?php include_once("inc/footer.nav.php"); ?>