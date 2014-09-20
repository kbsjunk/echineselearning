$(function () {
	$('[data-datetimepicker]').datetimepicker({
		useCurrent: false,
		useMinutes: false,
		sideBySide: true,
		minuteStepping: 60,
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar-o',
			up:   'fa fa-angle-up',
			down: 'fa fa-angle-down'
		}
	});
});