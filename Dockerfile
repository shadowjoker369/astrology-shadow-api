# Use official PHP image
FROM php:8.1-cli

# Set working directory
WORKDIR /var/www/html

# Copy files into container
COPY . .

# Install curl extension (needed for API request)
RUN docker-php-ext-install curl

# Expose port 10000
EXPOSE 10000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000", "index.php"]
