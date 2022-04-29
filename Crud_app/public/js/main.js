//get the table in the page
const drivingInstructors = document.getElementById("table")
const students = document.getElementById("student-table")


if (drivingInstructors) {
    //click event
    drivingInstructors.addEventListener('click', e => {
        //if click was on a delete button
        if (e.target.className === 'btn btn-danger delete-instructor') {
            //asks user to confirm action
            if (confirm("are you sure you want to delete this instructor")) {
                id = e.target.getAttribute('data-id')

                //delete is actioned
                fetch(`/di/delete/${id}`, {
                        method: 'DELETE'
                    })
                    .then(res => window.location.reload())

            }
            alert("Instructor has been deleted");
        }
    })
} else if (students) {
    //click event
    students.addEventListener('click', e => {
        alert("click")
            //if click was on a delete button
        if (e.target.className === 'btn btn-danger delete-student') {
            //asks user to confirm action
            if (confirm("are you sure you want to delete this student")) {
                id = e.target.getAttribute('data-id')

                //delete is actioned
                fetch(`/student/delete/${id}`, {
                        method: 'DELETE'
                    })
                    .then(res => window.location.reload())

            }
            alert("student has been deleted");
        }
    })
}