<template>
  <div>
  <table class="table table-bordered">
    <tr>
      <th>№</th>
      <th>Имя</th>
      <th>E-mail</th>
      <th>Роли</th>
      <th width="300px">Действия</th>
    </tr>
    <tr v-for="(user, index) in users" :key="user.id">
      <td>{{ index+1 }}</td>
      <td>{{ user.name }}</td>
      <td>{{ user.email }}</td>
      <td>
        <label class="badge badge-success" v-if="user.role">{{ user.role.name }}</label>
      </td>
      <td>
        <a class="btn btn-info" href="#">Показать</a>
        <a class="btn btn-primary" href="#">Изменить</a>
        <a class="btn btn-danger" href="#">Удалить</a>
      </td>
    </tr>
  </table>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous" @click.prevent="prevPageUrl()">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item" v-for="pageNo in pagination.last_page" :class="{ active: (pagination.current_page == pageNo) }">
        <a class="page-link" href="#" @click.prevent="PageUrl(pageNo)">{{ pageNo }}</a>
      </li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPageUrl()">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>

  </div>
</template>

<script>

  import Bus from './Bus.js';

  export default {
    data(){
      return{
        pagination: {},
        users: {}
      }
    },
    created() {
      axios.get('/showUsers')
        .then(({data}) => {
          console.log(data.data);
          this.pagination = data;
          this.users = data.data;
        });    
    },
    methods: {
      nextPageUrl() {
        if (this.pagination.current_page != this.pagination.last_page) {
          axios.get(this.pagination.next_page_url)
            .then(({data}) => {
              this.pagination = data;
              this.users = data.data;
            });
        }
      },
      prevPageUrl() {
        if (this.pagination.current_page != 1) {
          axios.get(this.pagination.prev_page_url)
            .then(({data}) => {
              this.pagination = data;
              this.users = data.data;
            });
        }
      },
      PageUrl(pageNo) {
        if (this.pagination.current_page != pageNo) {
          axios.get(this.pagination.path+'?page='+pageNo)
            .then(({data}) => {
              this.pagination = data;
              this.users = data.data;
            });
        }
      },
    }        
  };
</script>
