<?php include_once(TEMPLATES . '_includes/head.php');?>
<?php include_once(TEMPLATES . '_includes/nav.php');?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><?=$pageName;?></h2>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" data-student-action="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student) { ?>
                        <tr>
                            <th><?=$student['id'];?></th>
                            <th><?=$student['last_name'];?></th>
                            <th><?=$student['first_name'];?></th>
                            <th>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a type="button" class="btn btn-info btn-sm" href="/index.php?p=student&a=view&studentId=<?=$student['id'];?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" data-student-id="<?=$student['id'];?>" data-student-action="edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                    				<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" data-student-id="<?=$student['id'];?>" data-student-action="delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                </div>
                            </th>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once(TEMPLATES . '_includes/modal.php');?>
        <?php include_once(TEMPLATES . '_includes/form.php');?>
<?php include_once(TEMPLATES . '_includes/footer.php');?>