import BaseUrl from '../../helpers/BaseUrl.js';
import axiosIns from '../../libs/axios';

export async function getGroups(context, params = '') {
	const url = BaseUrl.getUrl('api/groups' + params);
	const request = await axiosIns.get(url);
	return request;
}

export async function save(context, data) {
	const url = BaseUrl.getUrl('api/groups');
	const request = await axiosIns.post(url, data);
	return request;
}

export async function saveGroupChangesByProject(context, data) {
	const url = BaseUrl.getUrl('api/projects/' + data.projectId + '/groups');
	const request = await axiosIns.put(url, data);
	return request;
}

export async function getGroupsByProject(context, projectId) {
	const url = BaseUrl.getUrl('api/projects/' + projectId + '/groups' );
	const request = await axiosIns.get(url);
	
	return request;
}

export async function getGroupsByProjectForSale(context, projectId) {
	const url = BaseUrl.getUrl('api/projects/' + projectId + '/groups/onsale' );
	const request = await axiosIns.get(url);
	
	return request;
}
