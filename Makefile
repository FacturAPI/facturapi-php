.PHONY: install test test-coverage clean format analyze lint pre-commit

# Instala las dependencias del proyecto usando Composer
install:
	composer install

# Corre todos los tests con Pest
test:
	./vendor/bin/pest

# Corre todos los tests mostrando el reporte de cobertura (requiere PCOV o Xdebug habilitado)
test-coverage:
	./vendor/bin/pest --coverage

# Elimina las dependencias instaladas (útil para limpiar el entorno)
clean:
	rm -rf vendor composer.lock

# Comandos de linting y análisis
format:
	composer format

analyze:
	composer analyze

lint:
	composer lint

# Corre las herramientas de formato, análisis y tests (ideal para antes de un commit)
pre-commit: format analyze test
