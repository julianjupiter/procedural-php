$(document).ready(function(){
    // Thesis Modal
    $("#myModal").modal({
        keyboard: true,
        backdrop: "static",
        show: false,
    }).on("show.bs.modal", (event) => {
        let button = $(event.relatedTarget); // button clicked
        let studentId = button.data('student-id'); // ID of thesis taken from data-student-id
        let studentAction = button.data('student-action'); // action to do from data-student-action

        switch(studentAction) {
            case 'add':
                addStudent(this); // this = is the #studentModal
                break;
                
            case 'edit':
                editStudent(this, studentId); // this = is the #studentModal
                break;
                
            case 'delete':
                deleteStudent(this, studentId); // this = is the #studentModal
                break;
        }        
    }).on('hidden.bs.modal', (event) => {
        // Upon close of modal, clear every thing added/insert to modal when it was opened.
        $(this).find('.modal-title').html('');
        $(this).find('.modal-body').html('');
        $(this).find('.modal-footer').html('');
        location.reload();
    });
});

let modalTitle = $('.modal-title');
let modalBody = $('.modal-body');
let studentFormHidden = $('#studentForm:hidden'); // Fetch and clone the Student Form <see student/index.php> 
let studentForm = '#studentForm';
let modalFooter = $('.modal-footer');
let closeStudentModal = $('<button id="closeStudentModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
let addStudentModal = $('<button id="addStudentModal" type="submit" class="btn btn-primary">Add</button>');
let updateStudentModal = $('<button id="updateStudentModal" type="submit" class="btn btn-primary">Update</button>');
let deleteStudentModal = $('<button id="deleteStudentModal" type="submit" class="btn btn-danger">Delete</button>');

function addStudent(modal) {
    $(modal).find(modalTitle).html('Add Student');
    $(modal).find(modalBody).html(studentFormHidden.clone()); // Insert Student Form
    $(modal).find(studentForm).css('display', 'block'); // Show Student Form from hidden after inserted <see previous line>
    $(modal).find(modalFooter).append(closeStudentModal); // Insert Close button
    $(modal).find(modalFooter).append(addStudentModal); // Insert Add button

    $(modal).find('#addStudentModal').click((event) => {
        $(modal).find('.alert').remove();
        let lastName = $.trim($(modal).find('#lastName').val());
        let firstName = $.trim($(modal).find('#firstName').val());
        let dateOfBirth = $.trim($(modal).find('#dateOfBirth').val());
        let address = $.trim($(modal).find('#address').val());
        
        if (lastName !== '' && firstName !== '' && dateOfBirth !== '' && address !== '') {
            let params = 'lastName=' + lastName +
            '&firstName=' + firstName +
            '&dateOfBirth=' + dateOfBirth +
            '&address=' + address;
            console.log(params);
            let request = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: params
            };
            
            fetch('index.php?p=student&a=add', request)
                .then(response => {
                    return response.json();
                })
                .then(data => {   
                    let studentId = data.studentId;
                    if (studentId > 0) {
                        let message = 'Student with ID ' + studentId + ' was added successfully!';
                        let buttonToRemove = $('button#addStudentModal');
                        confirmationMessage(modal, message, buttonToRemove);
                    }
                })
                .catch(error => {
                    console.log('Request failed', error);
                    let buttonToRemove = $('button#addStudentModal');
                    errorMessage(modal, buttonToRemove);
                });
        } else {
            let errorMessage = $('<div class="alert alert-danger" role="alert">Please complete fields!</div>');
            $(modal).find(studentForm).prepend(errorMessage);
        }
    });
}

function editStudent(modal, studentId) {
    let studentIdInput = $(`<div class="form-group">
						       <label for="id">ID</label>
							    <input type="text" id="studentId" class="form-control" value="${studentId}" disabled="disabled">
						   </div>`);

    $(modal).find(modalTitle).html('Edit Student'); 
    $(modal).find(modalBody).html(studentFormHidden.clone()); // Insert Student Form
    $(modal).find(studentForm).css('display', 'block'); // Show Student Form from hidden after inserted <see previous line>
    $(modal).find(studentForm).prepend(studentIdInput);
    $(modal).find(modalFooter).append(closeStudentModal); // Insert Close button
    $(modal).find(modalFooter).append(updateStudentModal); // Insert Update button
    
    fetch('/index.php?p=student&a=edit&studentId=' + studentId)
        .then(response => {
            return response.json();
        })
        .then(data => {
            $(modal).find('#lastName').val(data.last_name);
            $(modal).find('#firstName').val(data.first_name);
            $(modal).find('#dateOfBirth').val(data.date_of_birth);
            $(modal).find('#address').val(data.address);
        })
        .catch(error => {
            console.log('Request failed', error);
        });

     $(modal).find('#updateStudentModal').click((event) => {
         $(modal).find('.alert').remove();
        let lastName = $.trim($(modal).find('#lastName').val());
        let firstName = $.trim($(modal).find('#firstName').val());
        let dateOfBirth = $.trim($(modal).find('#dateOfBirth').val());
        let address = $.trim($(modal).find('#address').val());
        
        if (lastName !== '' && firstName !== '' && dateOfBirth !== '' && address !== '') {
            let params = 'studentId=' + studentId +
            '&lastName=' + lastName +
            '&firstName=' + firstName +
            '&dateOfBirth=' + dateOfBirth +
            '&address=' + address;
            
            let request = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: params
            };
            
            fetch('index.php?p=student&a=update', request)
                .then(response => {
                    return response.json();
                })
                .then(data => {   
                    if (data.rowCount > 0) {
                        let message = 'Student with ID ' + studentId + ' was updated successfully!';
                        let buttonToRemove = $('button#updateStudentModal');
                        confirmationMessage(modal, message, buttonToRemove);
                    }
                })
                .catch(error => {
                    console.log('Request failed', error);
                    let buttonToRemove = $('button#updateStudentModal');
                    errorMessage(modal, buttonToRemove);
                });
        } else {
            let errorMessage = $('<div class="alert alert-danger" role="alert">Please complete fields!</div>');
            $(modal).find(studentForm).prepend(errorMessage);
        }
    });
}

function deleteStudent(modal, studentId) {
    let content = 'Are you sure you want to delete Student with ID ' + studentId + '?';
    $(modal).find(modalTitle).html('Delete Student');
    $(modal).find(modalBody).html(content);
    $(modal).find(modalFooter).append(closeStudentModal); // Insert Close button
    $(modal).find(modalFooter).append(deleteStudentModal); // Insert Delete button

    $(modal).find('#deleteStudentModal').click((event) => {
        fetch('/index.php?p=student&a=delete&studentId=' + studentId)
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data.rowCount > 0) {
                let message = 'Student with ID ' + studentId + ' was deleted successfully!';
                let buttonToRemove = $('button#deleteStudentModal');
                confirmationMessage(modal, message, buttonToRemove);
            }
        })
        .catch(error => {
            console.log('Request failed', error);
            let buttonToRemove = $('button#deleteStudentModal');
            errorMessage(modal, buttonToRemove);
        });
    });
}

function confirmationMessage(modal, message, buttonToRemove) {
    $(modal).find(modalBody).html('');
    $(modal).find(modalBody).html(message);
    $(modal).find(buttonToRemove).remove();
}

function errorMessage(modal, buttonToRemove) {
    let error = 'An error occurred. Please try again later!';
    $(modal).find(modalBody).html('');
    $(modal).find(modalBody).html(error);
    $(modal).find(buttonToRemove).remove();
}