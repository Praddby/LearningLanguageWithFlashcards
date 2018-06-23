<template>
  <div>
    <div class="table" v-show="!isUser">
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
          <td v-if="(showEdite && user.id == showEdite)">
            <form>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-secondary" type="submit" @click="changeRole(user)">Button</button>
                </div>
                <select class="custom-select" id="inputGroupSelect03" v-model="selectedRole">
                  <option :value="role" v-for="(role, index) in roles" :key="role.id">{{ role.name }}</option>
                </select>
              </div>
            </form>
          </td>
          <td v-if="!(showEdite && user.id == showEdite)">
            <label class="badge badge-success" v-if="user.role">{{ user.role.name }}</label>
          </td>
          <td>
            <a class="btn btn-info" href="#" @click="showUser(user.id)">Показать</a>
            <a class="btn btn-primary" href="#" @click="showEditeRoleUser(user.id)">Изменить</a>
            <a class="btn btn-danger" href="#" @click="destroyUserRole(user)">Удалить</a>
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
    <div class="user" v-show="isUser">
      <div class="row">
        <div class="col-lg-12 margin-tb">
          <div class="pull-left">
            <h2> Пользователь </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Имя:</strong>
            {{ user_role.name }}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Email:</strong>
            {{ user_role.email }}
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group" v-if="user_role.role">
            <strong>Роль:</strong>
            <label class="badge badge-success">{{ user_role.role.name }}</label>
          </div>
        </div>
      </div>
      <div class="pull-right">
        <a class="btn btn-primary" href="#" @click="showTableUsers"> Назад </a>
      </div>
    </div>

  </div>
</template>

<script>

  import Bus from './Bus.js';

  export default {
    data(){
      return{
        pagination: {},
        users: {},
        user_role: {},
        isUser: false,
        showEdite: false,
        roles: {},
        selectedRole: ''
      }
    },
    created() {
      axios.get('/showUsers')
        .then(({data}) => {
          this.pagination = data.data;
          this.users = data.data.data;
          this.roles = data.role;
        });    
    },
    methods: {
      nextPageUrl() {
        if (this.pagination.current_page != this.pagination.last_page) {
          axios.get(this.pagination.next_page_url)
            .then(({data}) => {
              this.pagination = data.data;
              this.users = data.data.data;
            });
        }
      },
      prevPageUrl() {
        if (this.pagination.current_page != 1) {
          axios.get(this.pagination.prev_page_url)
            .then(({data}) => {
              this.pagination = data.data;
              this.users = data.data.data;
            });
        }
      },
      PageUrl(pageNo) {
        if (this.pagination.current_page != pageNo) {
          axios.get(this.pagination.path+'?page='+pageNo)
            .then(({data}) => {
              this.pagination = data.data;
              this.users = data.data.data;
            });
        }
      },
      showUser(id){
        axios.get('user_roles/' + id)
          .then(({data}) => {
            this.user_role = data;
            this.isUser = true;
          });
      },
      showTableUsers(){
        this.isUser = false;
      },
      showEditeRoleUser(id){
        this.showEdite = id;
      },
      destroyUserRole(user){
        axios.delete('user_roles/' + user.id)
          .then(({data}) => {
            user.role = null;
          });
      },
      changeRole(user){
        axios.put('user_roles/' + user.id, { role: this.selectedRole, roleId: this.selectedRole.id } )
          .then(({data}) => {
            user.role = this.selectedRole;
            this.showEdite = false;
          });
      },
    }        
  };
</script>
