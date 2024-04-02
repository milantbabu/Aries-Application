if (page == 'attendExam') {
	$('#attend_form').validate({
		submitHandler: function (form, e) {
			e.preventDefault();
			$('#cover-spin').show();
			$.ajax({
				type: "POST",
				url: saveURL,
				data: {
					'name': $('#name').val(),
					'email': $('#email').val(),
					'exam_id': examId
				},
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            success: function (response) {
	            	$('#cover-spin').hide();
	            	if (response.status == 'success') {
	                    window.location.replace(response.next);
	             	} else if (response.status == 'validationError') {
	             		$.each(response.messages, function (index, value) {
	                        $("input[name='" + index + "']").after('<label class="error">' + value[0] + '</label>');
	                    });
	             	} else if (response.status == 'error') {
	             		toastr.error('Something went wrong.', 'Error');
	             	}
	            },
	            error: function (error) {
	                toastr.error('Something went wrong', 'Error');
	                $('#cover-spin').hide();
	            }
			});
		}
	})
} else if (page == 'startExam') {

	$('#submit_exam_form').validate({
		submitHandler: function (form, e) {
			e.preventDefault();
			$('#cover-spin').show();
			let formData = $('#submit_exam_form').serializeArray();
			// console.log(formData);
			$.ajax({
				type: "POST",
	            url: saveExamurl,
	            data: formData,
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            success: function (response) {
	            	$('#cover-spin').hide();
	            	if (response.status == 'success') {
	            		window.location.replace(response.next);
	            	} else {
	            		toastr.error('Please answer all questions.', 'Error');
	            	}
	            },
	            error: function (error) {
	                toastr.error('Something went wrong', 'Error');
	                $('#cover-spin').hide();
	            }
			});
		}
	});
} else if (page == 'resultPage') {
	table = $('#result_table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        stateSave: true,
        ajax: tableURL,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtpli',
        buttons: [
        ],
        initComplete: function () {
            var exportButton = $('.dt-button');
            exportButton.removeClass('dt-button');
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'exam',
                name: 'exam'
            },
            {
                data: 'mark',
                name: 'mark'
            },
            {
                data: 'total_mark',
                name: 'total_mark'
            },
        ]
    });
}
