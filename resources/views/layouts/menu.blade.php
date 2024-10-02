<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 1) { ?>

<style>
.treeview.active>a span{
	color:orange !important;
}
.active.menu-open .treeview-menu{
	display:block;
}
</style>


<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{{ route('/home') }}"><i class="fa fa-edit"></i><span>Book Statistics</span></a>
</li>

<!--added rahul-->
<li class="treeview {{  (Request::is('admlogins*') || Request::is('appUsers*') || Request::is('subscribers*')) ? 'active menu-open' : '' }}">
	<a>
		<i class="fa fa-circle-o"></i> <span>Users</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('admlogins*') ? 'active' : '' }}">
			<a href="{{ route('admlogins.index') }}"><i class="fa fa-edit"></i><span>Admins</span></a>
		</li>
		<li class="{{ Request::is('appUsers*') ? 'active' : '' }}">
			<a href="{{ route('appUsers.index') }}"><i class="fa fa-edit"></i><span>App Users</span></a>
		</li>
		<li class="{{ Request::is('subscribers*') ? 'active' : '' }}">
			<a href="{{ route('subscribers.index') }}"><i class="fa fa-edit"></i><span>User Subscription</span></a>
		</li>
		<li class="{{ Request::is('order*') ? 'active' : '' }}">
			<a href="{{ route('order.index') }}"><i class="fa fa-edit"></i><span>User Orders</span></a>
		</li>
		<li class="{{ Request::is('transaction*') ? 'active' : '' }}">
			<a href="{{ route('transaction.index') }}"><i class="fa fa-edit"></i><span>Transactions</span></a>
		</li>
		<li class="{{ Request::is('coupon_codes*') ? 'active' : '' }}">
			<a href="{{ route('coupon_codes.index') }}"><i class="fa fa-edit"></i><span>Coupon Codes</span></a>
		</li>
	</ul>
</li>
<!--added rahul-->






<li class="{{ Request::is('bookPublishers*') ? 'active' : '' }}">
    <a href="{{ route('bookPublishers.index') }}"><i class="fa fa-edit"></i><span>Book Publishers</span></a>
</li>

<!--added rahul-->
<li class="treeview {{  (Request::is('manageschools*') || Request::is('prescribedReadingLists*') || Request::is('schooltokens*'))? 'active menu-open' : '' }}">
	<a>
		<i class="fa fa-circle-o"></i> <span>Schools</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('manageschools*') ? 'active' : '' }}">
			<a href="{{ route('manageschools.index') }}"><i class="fa fa-edit"></i><span>Manage Schools</span></a>
		</li>
		<li class="{{ Request::is('prescribedReadingLists*') ? 'active' : '' }}">
			<a href="{{ route('prescribedReadingLists.index') }}"><i class="fa fa-edit"></i><span>Reading Lists(Prescribed)</span></a>
		</li>
		<!--
		<li class="{{ Request::is('schooltokens*') ? 'active' : '' }}">
			<a href="{{route('list')}}"><i class="fa fa-edit"></i><span>School Tokens</span></a>
		</li>
		-->
	</ul>
</li>
<!--added rahul-->


<!--added rahul-->
<li class="treeview {{  (Request::is('genres*') || Request::is('appDepartments*') || Request::is('appSubjects*'))? 'active menu-open' : '' }}">
	<a>
		<i class="fa fa-circle-o"></i> <span>App Genres</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ Request::is('genres*') ? 'active' : '' }}">
			<a href="{{ route('genres.index') }}"><i class="fa fa-edit"></i><span>Genre List</span></a>
		</li>
		<li class="{{ Request::is('appDepartments*') ? 'active' : '' }}">
			<a href="{{ route('appDepartments.index') }}"><i class="fa fa-edit"></i><span>Department List</span></a>
		</li>

		<li class="{{ Request::is('appSubjects*') ? 'active' : '' }}">
			<a href="{{ route('appSubjects.index') }}"><i class="fa fa-edit"></i><span>Subject List</span></a>
		</li>
	</ul>
</li>
<!--added rahul-->




<!-- <li class="{{ Request::is('sgenres*') ? 'active' : '' }}">
    <a href="{{ route('sgenres.index') }}"><i class="fa fa-edit"></i><span>Sgenre</span></a>
</li> -->

<!-- <li class="{{ Request::is('region*') ? 'active' : '' }}">
    <a href="{{ route('region.index') }}"><i class="fa fa-edit"></i><span>Region</span></a>
</li> -->


<li class="{{ Request::is('languages*') ? 'active' : '' }}">
    <a href="{{ route('languages.index') }}"><i class="fa fa-edit"></i><span>Language</span></a>
</li>

<li class="{{ Request::is('appMaterials*') ? 'active' : '' }}">
    <a href="{{ route('appMaterials.index') }}"><i class="fa fa-edit"></i><span>App Materials</span></a>
</li>

<li class="{{ Request::is('materials*') ? 'active' : '' }}">
    <a href="{{ route('materials.index') }}"><i class="fa fa-edit"></i><span>Materials</span></a>
</li>

<!-- <li class="{{ Request::is('customer_feedback*') ? 'active' : '' }}">
    <a href="{{ route('customer_feedback.index') }}"><i class="fa fa-edit"></i><span>Customer Feedback</span></a>
</li> -->

{{-- <li class="{{ Request::is('genreHighlights*') ? 'active' : '' }}">
    <a href="{{ route('genreHighlights.index') }}"><i class="fa fa-edit"></i><span>Genre Highlights</span></a>
</li> --}}

<li class="{{ Request::is('appPublishers*') ? 'active' : '' }}">
    <a href="{{ route('appPublishers.index') }}"><i class="fa fa-edit"></i><span>Publishers Registrations</span></a>
</li>

<li class="{{ Request::is('appAdvs*') ? 'active' : '' }}">
    <a href="{{ route('appAdvs.index') }}"><i class="fa fa-edit"></i><span>App Advs</span></a>
<li class="{{ Request::is('cmsPages*') ? 'active' : '' }}">
    <a href="{{ route('cmsPages.index') }}"><i class="fa fa-edit"></i><span>Cms Pages</span></a>
</li>
<li class="{{ Request::is('subscriptionPlans*') ? 'active' : '' }}">
    <a href="{{ route('subscriptionPlans.index') }}"><i class="fa fa-edit"></i><span>Subscription Plans</span></a>
</li>

<li class="{{ Request::is('appLogos*') ? 'active' : '' }}">
    <a href="{{ route('appLogos.index') }}"><i class="fa fa-edit"></i><span>App Logos</span></a>
</li>
<li class="{{ Request::is('externalApps*') ? 'active' : '' }}">
    <a href="{{ route('externalApps.index') }}"><i class="fa fa-edit"></i><span>External Apps</span></a>
</li>
<li class="{{ Request::is('teacherDetails*') ? 'active' : '' }}">
    <a href="{{ route('teacherDetails.index') }}"><i class="fa fa-edit"></i><span>Teacher Details</span></a>
</li>

<li class="{{ Request::is('user.data.overview*') ? 'active' : '' }}">
    <a href="{{ route('user.data.overview') }}"><i class="fa fa-edit"></i><span>User Data Overview</span></a>
</li>

<li class="{{ Request::is('ai.resources.index*') ? 'active' : '' }}">
    <a href="{{ route('ai.integration.index') }}"><i class="fa fa-edit"></i><span>Ai Integration</span></a>
</li>
{{-- <li class="{{ Request::is('Subscriptions*') ? 'active' : '' }}">
    <a href="{{ route('subscriptions.index') }}"><i class="fa fa-edit"></i><span>Subscription Trnx</span></a>
</li>--}}
<?php } else { ?>
    <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a href="{{ route('/home') }}"><i class="fa fa-edit"></i><span>Book Statistics</span></a>
    </li>
<li class="{{ Request::is('appMaterials*') ? 'active' : '' }}">
    <a href="{{ route('appMaterials.index') }}"><i class="fa fa-edit"></i><span>App Materials</span></a>
</li>
<li class="treeview {{  (Request::is('manageschools*') || Request::is('prescribedReadingLists*') || Request::is('schooltokens*'))? 'active menu-open' : '' }}">
	<a>
		<i class="fa fa-circle-o"></i> <span>Schools</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		
		<li class="{{ Request::is('prescribedReadingLists*') ? 'active' : '' }}">
			<a href="{{ route('prescribedReadingLists.index') }}"><i class="fa fa-edit"></i><span>Reading Lists(Prescribed)</span></a>
		</li>
		<!--
		<li class="{{ Request::is('schooltokens*') ? 'active' : '' }}">
			<a href="{{route('list')}}"><i class="fa fa-edit"></i><span>School Tokens</span></a>
		</li>
		-->
	</ul>
</li>
<li class="{{ Request::is('pa_token_used*') ? 'active' : '' }}">
    <a href="{{ route('students') }}"><i class="fa fa-edit"></i><span>PA Token uses</span></a>
</li>
<?php } ?>









