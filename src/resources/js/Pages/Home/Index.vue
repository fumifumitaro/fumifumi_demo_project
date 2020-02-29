<template>
    <div>
        <header>
            <div class="items-right flex">
                <div class="header-links items-under" style="padding: 1em">
                    <a :href="$route('login')">
                        Login
                    </a>
                    <a :href="$route('logout')">
                        Logout
                    </a>
                    <a :href="$route('register')">
                        Register
                    </a>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="contents-box">
                <div class="content-title">
                    <h2>記事一覧</h2>
                </div>
                <el-table
                        :data="tableData"
                        style="width: 100%; padding: 1.5em">
                    <el-table-column
                            prop="name"
                            label="Author"
                            width="180">
                    </el-table-column>
                    <el-table-column
                            prop="address"
                            label="Title">
                    </el-table-column>
                    <el-table-column
                            prop="date"
                            label="Date"
                            width="180">
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [{
                    date: '2016-05-03',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-02',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-04',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-01',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }]
            }
        }
    }
</script>