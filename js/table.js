$(document).ready(function () {
  $("#DT_load").DataTable({
    ajax: {
      url: "api.php",
      type: "GET",
      dataType: "json",
    },
    lengthMenu: [5],
    lengthChange: false,
    columns: [
      { data: "name", width: "30%" },
      { data: "author", width: "30%" },
      {
        data: "id",
        render: function (data) {
          return `<div class="text-center">
                <input type="button" onclick="viewOrEdit(${data}, 'view')" value="View" class="btn btn-primary">
                <input type="button" onclick="viewOrEdit(${data}, 'edit')" value="Edit" class="btn btn-success">
                <input type="button" onclick="deleteBook(${data})" value="Delete" class="btn btn-danger">
            </div>`;
        },
        width: "40%",
      },
    ],
    language: {
      emptyTable: "No data to display",
    },
    width: "100%",
  });
});
