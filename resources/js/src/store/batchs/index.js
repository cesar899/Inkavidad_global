import state from './state';
import getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';

export default {
  namespaced: true,
  getters,
  mutations,
  actions,
  state
}
