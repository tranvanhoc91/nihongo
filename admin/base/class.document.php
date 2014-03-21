<?php
class Document {
	function getDocument(){}
}

class HTMLDocument extends Document {
	//php -> html
	//buildHeader
	//template
	//module
}

class PDFDocument extends Document {
	//su dung thu vien TCPDF de xuat du lieu xuong client
	//khong can template va khong can module
}

class RSSDocument extends Document {
	//su dung thu vien xu ly XML de xuat du lieu xuong client
	//xay dung viec xuat rss cho cac danh muc (category, subcategory)
}

class JSONDocument {
	//xuat du lieu JSON phuc vu cho cac thiet bi can lay du lieu
}

class SiteDocument {
	function SiteDocument(){
		switch(Request::get('format')){
			case 'pdf':
				$doc = new PDFDocument();
				break;
			case 'rss':
				$doc = new RSSDocument();
				break;
			case 'json':
				$doc = new JSONDocument();
				break;
			default:
				$doc = new HTMLDocument();
				break;
		}
		
		return $doc->getDocument();
	}
}