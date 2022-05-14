<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Title Page-->
    <title>transfer</title>

    <!-- Font special for pages -->
    <!-- NOTE: DOWNLOAD THE FONTS LATER FOR OFFLINE USE -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet" />

    <!-- Main CSS-->
    <link href="../assets/css/payment-form.css" rel="stylesheet" media="all" />
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Transfer to Another Bank Account</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="transferProcess.php">
                        <div class=" form-row">
                            <div class="name">Account No.</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Acc" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Transfer Desc.</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="trans" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Transfer Reason</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="subject">
                                            <option disabled="disabled" selected="selected">
                                                Select Type
                                            </option>
                                            <option>Reason 1</option>
                                            <option>Reason 2</option>
                                            <option>Reason 3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <a href="billing.php"><button class="btn btn--radius-2 btn--red" type="button">
                                    CANCEL
                                </button></a>
                            <button class="btn btn--radius-2 btn--green" type="submit" name="trasfer">
                                TRANSFER
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>