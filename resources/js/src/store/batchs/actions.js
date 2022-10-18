import BaseUrl from '../../helpers/BaseUrl.js';
import axiosIns from '../../libs/axios';

export async function getBatchs(context, params = '') {
	const url = BaseUrl.getUrl('api/batchs' + params);
	const request = await axiosIns.get(url);
	return request;
}

export async function getBatch(context, batchId ) {
	const url = BaseUrl.getUrl('api/batchs/' + batchId);
	const request = await axiosIns.get(url);
	return request;
}

export async function save(context, data) {
	const url = BaseUrl.getUrl('api/batchs');
	const request = await axiosIns.post(url, data);
	return request;
}

export async function getBatchByGroup(context, groupId) {
	const url = BaseUrl.getUrl(`api/groups/${groupId}/batchs`);
	const request = await axiosIns.get(url);
	return request;
}

