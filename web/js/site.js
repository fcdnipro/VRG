function createAuthor() {
    $.ajax({
        url:     "site/create-author",
        type:     "POST",
        dataType: "html",
        data: $("#author-form").serialize(),
        success: function(response) {
            $('#authorGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function editAuthor(id) {
    $.ajax({
        url:     "site/edit-author?id=" + id,
        type:     "GET",
        dataType: "html",
        success: function(response) {
            $('#AuthorModal').modal('show');
            $('#AuthorModal .modal-dialog').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function saveAuthor(id) {
    $.ajax({
        url:     "site/edit-author?id=" + id,
        type:     "POST",
        dataType: "html",
        data: $("#author-form").serialize(),
        success: function(response) {
            $('#authorGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function findAuthor(data) {
    $.ajax({
        url:     "site/find-author",
        type:     "POST",
        processData: false,
        contentType: false,
        dataType: "html",
        data: data,
        success: function(response) {
           $('#authorGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function refreshModel() {
    $.ajax({
        url:     "site/refresh-model",
        type:     "POST",
        dataType: "html",
        success: function(response) {
            $('#AuthorModal .modal-dialog').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function createBook() {
    $.ajax({
        url:     "site/create-book",
        type:     "POST",
        dataType: "html",
        data: $("#book-form").serialize(),
        success: function(response) {
            $('#bookGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function editBook(id) {
    $.ajax({
        url:     "site/edit-book?id=" + id,
        type:     "GET",
        dataType: "html",
        success: function(response) {
            $('#BookModal').modal('show');
            $('#BookModal .modal-dialog').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function saveBook(id) {
    $.ajax({
        url:     "site/edit-book?id=" + id,
        type:     "POST",
        dataType: "html",
        data: $("#book-form").serialize(),
        success: function(response) {
            $('#bookGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function refreshModelBook() {
    $.ajax({
        url:     "site/refresh-model-book",
        type:     "POST",
        dataType: "html",
        success: function(response) {
            $('#BookModal .modal-dialog').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function findBookAuthor(data) {
    $.ajax({
        url:     "site/find-book-author",
        type:     "POST",
        processData: false,
        contentType: false,
        dataType: "html",
        data: data,
        success: function(response) {
            $('#bookGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function findBook(data) {
    $.ajax({
        url:     "site/find-book",
        type:     "POST",
        processData: false,
        contentType: false,
        dataType: "html",
        data: data,
        success: function(response) {
            $('#bookGrid').html(response);
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function resetSearchBook() {
    $.ajax({
        url:     "site/reset-search-book",
        type:     "POST",
        success: function(response) {
            $('#bookGrid').html(response);
            $('#select2-book-authors_id-container').text('');
            $('#book-author-search-form #book-authors option:selected').text('');
            $('.text-book-find').val('');
        },
        error: function(response) {
            console.log("error");
        }
    });
}

$('body').on('click','.create-author-btn',function () {
    createAuthor();
})
    .on('click','.create-author',function () {
    refreshModel();
    $('#AuthorModal').modal('show');
    console.log('go');
})
    .on('click', '.edit-author-btn',function () {
    let id = ($(this).data("id"));
    saveAuthor(id);
})
    .on('change', '#book-author-search-form #book-authors',function (e) {
    let data = new FormData();
    data.append('text', $('#book-author-search-form #book-authors option:selected').text());
    findBookAuthor(data);
})
    .on('click', '.find-author',function (e) {
    e.preventDefault();
    let data = new FormData();
    data.append('text',$('.text-author-find').val());
    data.append('type',$('.type-author-find').val());
    findAuthor(data);
})
    .on('click', '.reset-author',function (e) {
    e.preventDefault();
    let data = new FormData();
    data.append('reset','reset');
    findAuthor(data);
})
    .on('click', '.find-book',function (e) {
    e.preventDefault();
    let data = new FormData();
    data.append('text',$('.text-book-find').val());
    findBook(data);
})
    .on('click', '.reset-book',function (e) {
    e.preventDefault();
    resetSearchBook();
})
    .on('click','.create-book-btn',function () {
    createBook();
})
    .on('click','.create-book',function () {
    $('#BookModal').modal('show');
    refreshModelBook();
})
    .on('click', '.edit-book-btn',function () {
    let id = ($(this).data("id"));
    saveBook(id);
});

$('#authorGrid').on('click', '.edit-author',function (e) {
    e.preventDefault();
    $('#AuthorModal').modal('show');
    let id = ($(this).data("id"));
    editAuthor(id);
});
$('#bookGrid').on('click', '.edit-book',function (e) {
    e.preventDefault();
    $('#BookModal').modal('show');
    let id = ($(this).data("id"));
    editBook(id);
});