$('.expand').click(function () {
  const query = $(this);
  $('#modalContent').text(query.attr('data'));
  $('#modalTitle').text(query.attr('title'));
  $('#myModal').modal('toggle');
});