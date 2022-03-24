'use strict'

export async function createData(url = '', data = {}) {
    return await axios.post(url, data);
}

export async function verifyData(url = '', data = {}) {
    return await axios.post(url, data);
}

export async function deleteData(url = '', data = {}) {
    return await axios.delete(url, data);
}

export async function updateData(url = '', id, data = {}) {
    return await axios.post(url, id, data);
}

export async function showData(url, id) {
    return await axios.get(url, id);
}

export async function getResult(url,params) {
    return await axios.get(url, {params: params});
}

export async function getRegion(url = '', data = {}) {
    return await axios.get(url, {params: data})
}

export async function getRoute(url = '', data = {}) {
    return await axios.get(url, data);
}

export default {
    createData,
    deleteData,
    updateData,
    verifyData,
    showData,
    getResult,
    getRegion,
    getRoute
}
