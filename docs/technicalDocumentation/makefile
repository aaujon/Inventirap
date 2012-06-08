all : images
	pdflatex doc.tex
	pdflatex doc.tex

image :
	dia -e images/controller.png -s 380x images/sources/controller.dia
	dia -e images/webserviceController.png -s x620 images/sources/webserviceController.dia
	dia -e images/view.png -s 300x images/sources/view.dia
	dia -e images/model.png -s x330 images/sources/model.dia

clean :
	find ./ -name "*.aux" -delete;
	find ./ -name "*.toc" -delete;
	find ./ -name "*.log" -delete;
	find ./ -name "*.out" -delete;
	find ./ -name "*.lot" -delete;

