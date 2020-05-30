import BaseService from './baseService';
export default class AuthService extends BaseService {

  register(name, email, password, password_confirmation){
    return new Promise((resolve, reject) => {
      this.axios.post('register', { name, email, password, password_confirmation})
      .then((response) => {
        this.localStorageSetUp(response);
        resolve(response.data.token);
      }).
      catch((error) => {
        console.log('Error from register authService', error.response.data);
        reject(error);
      })
    });
  }
  
  
  login(email, password) {
    return new Promise((resolve, reject) => {
      this.axios.post('login', { email, password })
        .then((response) => {
          this.localStorageSetUp(response);
          console.dir(response);
          resolve(response.data.token);
        }).
        catch ((error) => {
          console.dir(error);
          console.log('Error from login authService');
          reject(error);
        })
    });
  }

  localStorageSetUp(response) {
    window.localStorage.setItem('loginToken', response.data.token);
    window.localStorage.setItem('user_id', response.data.id);
    this.setAxiosHeader();
  }


  logout() {
    window.localStorage.removeItem('loginToken');
    window.localStorage.removeItem('user_id');
    delete this.axios.defaults.headers.common['Authorization'];
  }
}
export const authService = new AuthService();

