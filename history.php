<?php include_once("inc/header.nav.php"); ?>
<main>
    <div id="user-project-history-request-page">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li><a href="./system-questionnaire-step-one">Support and services</a></li>
                    <li>Project history</li>
                </ul>
                <div class="title-wrapper">
                    <hr class="my-0">
                    <h1 class="title mb-0">PROJECT HISTORY</h1>
                    <hr class="my-0">
                </div>
                <section class="text-center">
                    <aside class="mb-3">
                        This is a dedicated section for clients to keep the history of the installation and maintenance of the system.
                    </aside>
                    <p class=" bold-600">Please enter the Installation ID sent to your email address</p>
                    <div class="form-wrapper">
                        <form method="post" action="history-details">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="inst-id" aria-label="">
                                <div class="input-group-append">
                                    <button class="btn btn-white rounded-0" type="submit" id="proj_btn">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>