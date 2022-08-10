@php 
use App\Models\website_settings;
$settings = website_settings::find(1);
@endphp
<title>{{$settings->title}}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="colorlib" />

	<link rel="icon" href="{{asset('public/components')}}/assets/images/favicon.jpg" type="image/x-icon">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="{{asset('public/components')}}/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/icon/feather/css/feather.css">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/css/font-awesome-n.min.css">

	<link rel="stylesheet" href="{{asset('public/components')}}/bower_components/chartist/css/chartist.css" type="text/css" media="all">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/css/widget.css">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/pages/data-table/css/buttons.dataTables.min.css">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">


	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/bootstrap-daterangepicker/css/daterangepicker.css" />

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/datedropper/css/datedropper.min.css" />

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/spectrum/css/spectrum.css" />

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/jquery-minicolors/css/jquery.minicolors.css" />

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/css/pages.css">


	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/icon/themify-icons/themify-icons.css">

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/icon/icofont/css/icofont.css">

	<!-- <link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/assets/icon/font-awesome/css/font-awesome.min.css"> -->

	<link rel="stylesheet" type="text/css" href="{{asset('public/components')}}/bower_components/switchery/css/switchery.min.css">

	<link rel="stylesheet" href="{{asset('public/components')}}/bower_components/select2/css/select2.min.css" />

	<link rel="stylesheet" type="text/css" href="{{asset('public')}}/components/css/dtsel.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public')}}/components/css/style.css">

	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.14.3/dist/css/uikit.min.css" />
	<link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">




	<style type="text/css">
		.pub-date span {
    font-size: 13px !important;
	font-weight: bold;
}
.title b {
    font-size: 17px;
}

.title {
    margin-top: 20px;
    border-left: 4px solid #00bcd4;
    padding-left: 10px;
}

.input-signle-box {
    margin-top: 34px;
}

.input-signle-box select {
}
span#select2-student_id-qc-container {
    background: white !important;
    border: 1px solid lightgray;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    background: white;
    padding: 4px 13px;
    border: 1px solid lightgray;
    box-shadow: none;
}
span.select2-selection.select2-selection--single {
    border: none;
}
input.select2-search__field {
    outline: none;
}
.news_image {
    text-align: center !important;
}
	</style>