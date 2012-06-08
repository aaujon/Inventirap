all : images
	pdflatex doc.tex
	pdflatex doc.tex

image :
	dia -e images/controller.png -s 420x images/sources/controller.dia
	dia -e images/view.png -s 330x images/sources/view.dia

clean :
	find ./ -name "*.aux" -delete;
	find ./ -name "*.toc" -delete;
	find ./ -name "*.log" -delete;
	find ./ -name "*.out" -delete;
	find ./ -name "*.lot" -delete;

