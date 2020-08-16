$('.expand').click(function () {
  const query = $(this);
  $('#modalContent').text(query.attr('data'));
  $('#modalTitle').text(query.attr('title'));
  $('#myModal').modal('toggle');
});

function generateReport() {
  var q = queries.map(query => {
    return Object.values(query);
  });

  var keys = Object.keys(queries[0]);

  let csvContent = "data:text/csv;charset=utf-8,"
    + [keys, ...q].map(e => e.join(",")).join("\n");

  var encodedUri = encodeURI(csvContent);
  var link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", "queries.csv");
  document.body.appendChild(link); // Required for FF

  link.click();
}