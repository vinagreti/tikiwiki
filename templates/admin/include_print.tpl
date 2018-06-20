{* $Id: include_print.tpl 64684 2017-11-23 00:44:13Z rjsmelo $ *}
<form class="form-horizontal" action="tiki-admin.php?page=print" class="admin" method="post">
	{ticket}
	{include file='admin/include_apply_top.tpl'}
	<fieldset>
		<legend>{tr}PDF settings{/tr}</legend>
		{preference name=print_pdf_from_url}
		<div class="adminoptionboxchild print_pdf_from_url_childcontainer webkit">
			{preference name=print_pdf_webkit_path}
		</div>
		<div class="adminoptionboxchild print_pdf_from_url_childcontainer weasyprint">
			{preference name=print_pdf_weasyprint_path}
		</div>
		<div class="adminoptionboxchild print_pdf_from_url_childcontainer webservice">
			{preference name=print_pdf_webservice_url}
		</div>
		<div class="adminoptionboxchild print_pdf_from_url_childcontainer mpdf">
			{preference name=print_pdf_mpdf_orientation}
			{preference name=print_pdf_mpdf_size}
			{preference name=print_pdf_mpdf_printfriendly}
			{preference name=print_pdf_mpdf_toc}
			{preference name=print_pdf_mpdf_toclinks}
			{preference name=print_pdf_mpdf_tocheading}
			{preference name=print_pdf_mpdf_toclevels}
			{preference name=print_pdf_mpdf_pagetitle}
			{preference name=print_pdf_mpdf_header}
			{preference name=print_pdf_mpdf_footer}
			{preference name=print_pdf_mpdf_margin_left}
			{preference name=print_pdf_mpdf_margin_right}
			{preference name=print_pdf_mpdf_margin_top}
			{preference name=print_pdf_mpdf_margin_bottom}
			{preference name=print_pdf_mpdf_margin_header}
			{preference name=print_pdf_mpdf_margin_footer}
			{preference name=print_pdf_mpdf_hyperlinks}
			{preference name=print_pdf_mpdf_autobookmarks}
			{preference name=print_pdf_mpdf_columns}
			<input style="display:none">{* This seems to be required for the Chromium browser to prevent autofill the password with some password stored in the user's browser *}
			<input type="password" style="display:none" name="print_pdf_mpdf_password_autocomplete_off">{* This seems to be required for the Chromium browser to prevent autofill password with some password stored in the user's browser *}
			{preference name=print_pdf_mpdf_password}
			{preference name=print_pdf_mpdf_watermark}
			{preference name=print_pdf_mpdf_watermark_image}
			{preference name=print_pdf_mpdf_background}
			{preference name=print_pdf_mpdf_background_image}
 			{preference name=print_pdf_mpdf_coverpage_text_settings}
			{preference name=print_pdf_mpdf_coverpage_image_settings}


		</div>
		{preference name=allocate_memory_print_pdf}
		{preference name=allocate_time_print_pdf}
	</fieldset>

	<fieldset>
		<legend>{tr}Wiki print version{/tr}</legend>
		{preference name=print_wiki_authors}
		{preference name=feature_wiki_print}
		<div class="adminoptionboxchild" id="feature_wiki_print_childcontainer">
			{preference name=feature_wiki_multiprint}
		</div>
		{preference name=feature_print_indexed}
		{preference name=print_original_url_wiki}
	</fieldset>

	<fieldset>
		<legend>{tr}Articles{/tr}</legend>
		{preference name=feature_cms_print}
	</fieldset>

	<fieldset>
		<legend>{tr}Other features{/tr}</legend>
		{preference name=print_original_url_tracker}
		{preference name=print_original_url_forum}

	</fieldset>
	{include file='admin/include_apply_bottom.tpl'}
</form>
