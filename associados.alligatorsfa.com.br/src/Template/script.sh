#!/bin/bash
sed -i '/<nav/,/<\/nav>/d' $1
sed -i "1i<?php \$this->extend('/Comum/perfil'); ?>" $1
