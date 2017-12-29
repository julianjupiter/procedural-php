<?php include_once(TEMPLATES . '_includes/head.php');?>
<?php include_once(TEMPLATES . '_includes/nav.php');?>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?=$panelHeader;?></h3>
                        </div>
                        <div class="panel-body">
                            <table id="studentInformation" class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-right" scope="row">Student ID<th>
                                        <td><?=$student['id'];?><td>
                                    </tr>
                                    <tr>
                                        <th class="text-right" scope="row">Last Name<th>
                                        <td><?=$student['last_name'];?><td>
                                    </tr>
                                    <tr>
                                        <th class="text-right" scope="row">First Name<th>
                                        <td><?=$student['first_name'];?><td>
                                    </tr>
                                    <tr>
                                        <th class="text-right" scope="row">Date of Birth<th>
                                        <td><?=$student['date_of_birth'];?><td>
                                    </tr>
                                    <tr>
                                        <th class="text-right" scope="row">Address<th>
                                        <td><?=$student['address'];?><td>
                                    </tr>
                                </tbody>
                            </table>  
                        </div>
                    </div>
                    <a class="btn btn-default btn-sm" href="/index.php?p=student" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
<?php include_once(TEMPLATES . '_includes/footer.php');?>