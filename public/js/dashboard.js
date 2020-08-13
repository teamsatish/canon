$('.query-details').click(function () {
  const query = $(this);
  $('#modalContent').text(query.attr('data'));
  $('#myModal').modal('toggle');
});