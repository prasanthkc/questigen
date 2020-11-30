import { NgModule, Optional, SkipSelf } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { CommonModule } from '@angular/common';
@NgModule({
  declarations: [],
  providers: [],
  imports: [
    CommonModule,
    HttpClientModule
  ],
  exports: []
})
export class CoreModule {

    constructor(@Optional() @SkipSelf() core: CoreModule) {
        if (core) {
            throw new Error("You should import core module only in the root module")
        }
    }
}