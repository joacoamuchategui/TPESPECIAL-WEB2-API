<?php

require_once './config.php';

class Model
{

  protected $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $this->deploy();
  }

  function deploy()
  {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {

      $sql = <<<SQL
--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` int(11) NOT NULL,
  `memoria` varchar(30) NOT NULL,
  `pantalla` varchar(30) NOT NULL,
  `camara` varchar(30) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(100) NOT NULL,
  `img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre`, `marca`, `memoria`, `pantalla`, `camara`, `precio`, `stock`, `img`) VALUES
(33, 'IPhone 14', 9, '24', '6', '60', 200000, 20, 'https://w7.pngwing.com/pngs/60/414/png-transparent-iphone-14.png'),
(34, 'Moto G24', 10, '32', '6', '80', 2000000, 20, 'https://beercoffee.com.ar/wp-content/uploads/2024/08/Motorola-G24-Power-256GB-8GB-Dual-Sim-LTE-Listo-e1724172239201.png'),
(35, 'Samsung S22', 11, '32', '7', '50', 200080, 4, 'https://images.samsung.com/is/image/samsung/p6pim/ar/2202/gallery/ar-galaxy-s22-ultra-s908-sm-s908ezgmaro-thumb-530923137?$360_360_PNG$'),
(36, 'Xiaomi Redmi 13', 12, '64', '7', '80', 7000000, 7, 'https://www.cordobadigital.net/wp-content/uploads/2024/01/Redmi-Note-13-128gb-Mint-Green.jpeg'),
(37, 'TCL 30E', 13, '16', '6', '30', 400000, 8, 'https://bairesit.com.ar/Image/0/750_750-6127A-BALCAR11-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL,
  `img_marca` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `img_marca`) VALUES
(9, 'Apple', 'https://w7.pngwing.com/pngs/664/673/png-transparent-apple-logo-iphone-computer-apple-logo-company-heart-logo-thumbnail.png'),
(10, 'Motorola', 'https://w7.pngwing.com/pngs/932/415/png-transparent-motorola-xoom-logo-motorola-solutions-iphone-electronics-text-trademark-thumbnail.png'),
(11, 'Samsung', 'https://w7.pngwing.com/pngs/990/838/png-transparent-samsung-electronics-samsung-galaxy-samsung-logo-text-logo-black-thumbnail.png'),
(12, 'Xiaomi', 'https://w7.pngwing.com/pngs/835/385/png-transparent-xiaomi-mi-logo-xiaomi-mobile-phones-computer-icons-battery-charger-brand-miscellaneous-angle-text-thumbnail.png'),
(13, 'TCL', 'https://www.liblogo.com/img-logo/tc1509t54e-tcl-logo-tcl-vector-logo-ai--com.png');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_admin` int(11) NOT NULL,
  `nombre_admin` varchar(20) NOT NULL,
  `contraseña_admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_admin`, `nombre_admin`, `contraseña_admin`) VALUES
(1, 'webadmin', '$2y$10$1hHvef3gEb5gBqzMGK5PWuLk8rfNrd3lIH2fBrP9DJjGE62Lrq9ta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_marca` (`marca`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marcas` (`id_marca`);
COMMIT;
SQL;

      $this->db->exec($sql);
    }
  }
}
