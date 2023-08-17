# Unofficial MPL Indonesia Season 12 API

![Logo Proyek](https://mplid-storage.sgp1.digitaloceanspaces.com/season12/kv-banners/MPLID_BANNER.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=53XCITH3UP462OQE23ZY%2F20230817%2Fsgp1%2Fs3%2Faws4_request&X-Amz-Date=20230817T103759Z&X-Amz-SignedHeaders=host&X-Amz-Expires=21600&X-Amz-Signature=40547d29279f195f355533fd97c01ede6c620cd38f1f9ba430a9276667ce30dd)

This project is an unofficial API for MPL Indonesia Season 12 that fetches data from the website [https://id-mpl.com/](https://id-mpl.com/) and packages it into an API using the Laravel framework. The API documentation is provided using the Swagger package.

## Table of Contents

-   [Project Description](#project-description)
-   [Installation](#installation)
-   [Usage](#usage)
-   [API Documentation](#api-documentation)
-   [Contribution](#contribution)
-   [License](#license)

## Project Description

This project aims to provide easier access to MPL Indonesia Season 12 data through an API. Data is fetched from the [https://id-mpl.com/](https://id-mpl.com/) website and processed using the Laravel framework.

## Installation

Here are the steps to install and run the project in a local environment:

1. Clone this repository: `git clone https://github.com/Bayumaul/api-mpl-id.git`
2. Navigate to the project directory: `cd api-mpl-id`
3. Copy the `.env.example` file to `.env` and configure your database settings.
4. Install dependencies: `composer install`
5. Generate the application key: `php artisan key:generate`
6. Start the server: `php artisan serve`

## Usage

After installing the project, you can access the API at `http://localhost:8000/api`. Please refer to the API documentation for further information.

## API Documentation

API documentation is provided using the Swagger package. You can access the API documentation at [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation).

## Contribution

If you'd like to contribute to this project, please follow these steps:

1. Fork this repository.
2. Create a new feature branch: `git checkout -b new-feature`
3. Make necessary changes.
4. Commit your changes: `git commit -m 'Add new feature'`
5. Push to your branch: `git push origin new-feature`
6. Submit a pull request!

## License

This project is licensed under the MIT License. Please see the [LICENSE](LICENSE) file for more information.

---

Created by [Bayu Maulana Iksan](https://portofolio-bayumaul.vercel.app/)
