function parseResponse(data) {
	var bookshelf = document.getElementById("bookshelf");
 
	for (var i=0; i<6; i++) {
		var cover = data.reader_books[i].book_edition.covers.cover_medium;
		var title = data.reader_books[i].book_edition.title;
		var permalink = data.reader_books[i].permalink;
 
		var link = document.createElement("a");
		link.setAttribute("href",permalink);
 
		var img = document.createElement("img");
		img.setAttribute("src",cover);
		img.setAttribute("alt",title);
		if (i % 2 == 0) {
			img.setAttribute("class","odd");
		}
 
		link.appendChild(img);
		bookshelf.appendChild(link);
	}
}