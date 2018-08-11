<template>
  <div>
    <div class="alert alert-danger" role="alert" v-if="errors" v-for="error in errors">
      {{ error }}
    </div>
    <modal-delete :modal="modal" @delete="destroyRole"></modal-delete>
    <table class="table table-bordered">
      <tr>
        <th>№</th>
        <th>Роль</th>
        <th width="300px">Действия</th>
      </tr>
      <tr v-for="(role, index) in roles" :key="role.id">
        <td>{{ (pagination.current_page - 1) * 5 + index + 1 }}</td>
        <td>{{ role.name }}</td>
        <td>
          <a class="btn btn-danger" type="button" data-toggle="modal" @click="modal = role" data-target="#deleteModal" href="#">Удалить</a>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <div class="input-group mb-3">
            <input type="text" v-model="role" class="form-control" placeholder="Введите роль" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" @click="addRole()">Добавить</button>
            </div>
          </div>
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

  import ApiRole from '../../api/roles.js';
  import ApiPagination from '../../api/pagination.js';

  export default {
    data(){
      return{
        pagination: {},
        roles: {},
        role: '',
        errors: [],
        modal: {}
      }
    },
    created() {
      ApiRole.get().then(data => {
        this.pagination = data;
        this.roles = data.data;
      });
    },
    methods: {
      nextPageUrl() {
        if (this.pagination.current_page != this.pagination.last_page) {
          let params = {
            path: this.pagination
          };
          ApiPagination.next(params).then(data => {
            this.pagination = data;
            this.roles = data.data;
          });
        }
      },
      prevPageUrl() {
        if (this.pagination.current_page != 1) {
          let params = {
            path: this.pagination
          };
          ApiPagination.prev(params).then(data => {
            this.pagination = data;
            this.roles = data.data;
          });
        }
      },
      PageUrl(pageNo) {
        if (this.pagination.current_page != pageNo) {
          let params = {
            path: this.pagination,
            pageNo
          };
          ApiPagination.page(params).then(data => {
            this.pagination = data;
            this.roles = data.data;
          });
        }
      },
      addRole(){
        let params = {
          role: this.role
        };

        ApiRole.add(params)
          .then( (data) => {
            this.roles.push(data);
            this.role = '';
          }).catch( (error) => {
            this.errors =  error.response.data.errors.role;
          });
      },
      destroyRole: function(role) {
        ApiRole.delete(role.id)
          .then( (data) => {
            let idx = this.roles.indexOf(role);
            this.roles.splice(idx, 1);
          }).catch( (error) => {
            this.errors = [error.response.data.message];
          });
      }
    }        
  };
</script>
