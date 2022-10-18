import ToFormData from '../../helpers/ToFormData.js';
import BaseUrl from '../../helpers/BaseUrl.js';
import axiosIns from '../../libs/axios';

export async function getProjects(context, params = '') {
	const url = BaseUrl.getUrl('api/projects' + params);
	const request = await axiosIns.get(url);
	return request;
}

export async function save(context, data) {
	const url = BaseUrl.getUrl('api/projects');
	const formData = ToFormData.transform(data);
	const request = await axiosIns.post(url, formData);
	return request;
}

export async function getProject(context, projectId) {
	const url = BaseUrl.getUrl('api/projects/' + projectId);
	const request = await axiosIns.get(url);
	return request;
}

export async function getAvailableProjects(context, params = '') {
	const url = BaseUrl.getUrl('api/projects/availables');
	const request = await axiosIns.get(url);
	return request;
}



