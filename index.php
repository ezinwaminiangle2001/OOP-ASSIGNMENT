
<?php include 'Include/db-connect.php'; ?>
<?php include 'oopfunction/insert.php'; ?>

<?php 
    ob_start();

    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $regno = $_POST['regno'];

        $insert = new Databaseinsert();

        // Insert new record into "teachers" table
        $tableName = "users";
        $data = [
            "Fullname" => $fullname,
            "Regno" => $regno,
        ];
        $insert->insertIntoTable($tableName, $data);
        header("Location: welcome.php");
        exit; 
    }

     if (isset($_POST['Submit_teachers_info'])) {
        $name = $_POST['name'];
        $course = $_POST['course'];

        $combinedCourse = implode(", ", $course);

        $insert = new Databaseinsert();

        // Insert new record into "teachers" table
        $tableName = "teachers";
        $data = [
            "name" => $name,
            "course" => $combinedCourse,
        ];
        $insert->insertIntoTable($tableName, $data);

        header("Location: welcome.php");
        exit; 
    }

    // if (isset($_POST['update'])) {
    //     $fullname = $_POST['fullname'];
    //     $regno = $_POST['regno'];
    //     $id = $_POST['id'];

    //     $insert = new Databaseinsert();

    //     // Update record in "users" table
    //     $tableName = "users";
    //     $data = [
    //         "Fullname" => $fullname,
    //         "Regno" => $regno,
    //     ];
    //     $whereCondition = "id = " . $id;
    //     $insert->updateTable($tableName, $data, $whereCondition);
    //     header("Location: index.php");
    //     exit; 
    // }
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<style>
    .top{
        margin: 2rem 2rem 0;
    }

    /* Styles for small screens */
    @media (max-width: 576px) {
            #header1 {
                font-size: 24px;
            }

            .col-4,
            .col-8 {
                padding: 0;
            }

            .form-group,
            .card-body {
                margin-bottom: 15px;
            }

            .btn-group {
                margin-bottom: 10px;
            }

            table {
                font-size: 14px;
            }

            .row{
                display: block;
                justify-content: center;
                align-items: center;
                width: auto;
                margin: 0 auto;
            }

            .col-4{
                webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            .col-8{
                webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

    }

        /* Styles for medium screens */
        @media (min-width: 577px) and (max-width: 991px) {
            #header1 {
                font-size: 28px;
            }

            .col-4,
            .col-8 {
                padding: 0 10px;
            }

            .row{
                display: block;
                justify-content: center;
                align-items: center;
            }

            .col-4{
                webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            .col-8{
                webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

</style>

<body class="hold-transition">
    <div class="row top">
        <div class="col-4">
            <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" >
                <div class="card mb-3 p-3  bg-dark bg-gradient text-white col-mp-4">
                    <div class="card-body">
                        <h1 id = "header1">INSERT STUDENT DATA</h1>
                        <form method = "post" action = "#">
                        <div class="form-group mb-3">
                            <label for="exampleInputFullname1">Full Name</label>
                            <input name="fullname" type="text" class="form-control" id="exampleInputFullname1" aria-describedby="emailHelp" placeholder="Enter Full Name">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Reg Number</label>
                            <input name = "regno" type="text" class="form-control" id="exampleInputPassword1" placeholder="Reg Number">
                        </div>
                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        
                        <button type="submit" class="btn btn-primary" name ="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card card-outline card-primary">
                <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="20%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>FullName</th>
                            <th>Reg_No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM users");
                        while($row= $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo $row['Fullname'] ?></b></td>
                            <td><b><?php echo $row['Regno'] ?></b></td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="./updateform.php" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat">
                                    Update
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat" data-id="<?php echo $row['id'] ?>">
                                    Delete
                                    </button>
                            </div>
                            </td>
                        </tr>	
                    <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row top">
        <div class="col-4">
                <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" >
                    <div class="card mb-3 p-3  bg-dark bg-gradient text-white col-mp-4">
                        <div class="card-body">
                            <h1 id="header1">INSERT TEACHERS DATA</h1>
                            <form method="post" action="#">
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input required name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputPassword1">Course Offering</label>
                                    <select name="course[]" id="input" class="form-control custom-select custom-select-sm" multiple required>
                                        <option value="English">English</option>
                                        <option value="maths">maths</option>
                                        <option value="gst">GST</option>
                                        <option value="java">java</option>
                                        <option value="English">Data Structure</option>
                                        <option value="maths">Backend</option>
                                        <option value="gst">FrontEnd</option>
                                        <option value="java">Data Science</option>
                                    </select>
                                </div>
                                <!-- <br> -->
                                <button type="submit" class="btn btn-primary" name="Submit_teachers_info">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-8">
            <div class="card card-outline card-primary">
                <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="20%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM teachers");
                        while($row= $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo $row['name'] ?></b></td>
                            <td><b><?php echo $row['course'] ?></b></td>

                            <td class="text-center">
                                <div class="btn-group">
                                <a href="./updateform.php" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat">
                                    Update
                                    </a>
                                    <!-- <button type="button" class="btn btn-primary btn-flat btn-update" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['id'] ?>">Update</button> -->
                                    <button type="button" class="btn btn-danger btn-flat btn-delete" data-id="<?php echo $row['id'] ?>">Delete</button>
                                </div>
                            </td>
                        </tr>	

                    <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
