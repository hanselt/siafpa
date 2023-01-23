<?php
  /**
   * Función para unir de forma segura los items de un array.
   * @param string $glue, mixed $array
   * @return string
   */
  function safe_implode($glue, $array) {
    return is_array($array) ? implode($glue, $array) : '';
  }
