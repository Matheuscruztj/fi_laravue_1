<template>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#" :to="{ name: 'Index' }">Index</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ms-auto navbar-right">
          <b-nav-item :to="{ name: 'TipoDocumento' }">Tipo de documentos</b-nav-item>
          <b-nav-item :to="{ name: 'Mock' }">Mock</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
</template>

<script>
export default {
  name: 'Navbar'
}
</script>
